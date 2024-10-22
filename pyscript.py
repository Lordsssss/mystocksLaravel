import mysql.connector
from mysql.connector import Error
from datetime import datetime
import json
import websocket
import os
from dotenv import load_dotenv
load_dotenv()
# Initialize the connection as None
connection = None

def get_connection():
    global connection
    if connection is None or not connection.is_connected():
        try:
            connection = mysql.connector.connect(
                host='localhost',
                database='my_stocks',
                user='root',
                password='mysql',
            )
            if connection.is_connected():
                print("Connected to the database.")
        except Error as e:
            print(f"Error: {e}")
            connection = None
    return connection

def update_stock_price(symbol, price):
    try:
        conn = get_connection()
        if conn is None:
            print("Failed to connect to the database.")
            return

        cursor = conn.cursor()

        # Use parameterized queries to prevent SQL injection
        update_query_stock = """
        UPDATE stock
        SET current_price = %s
        WHERE stock_symbol = %s;
        """
        update_query_stock_prices = """
        INSERT INTO stock_prices (stock_symbol, price, price_date)
        VALUES (%s, %s, %s);
        """

        # Execute queries with parameters
        cursor.execute(update_query_stock, (price, symbol))
        cursor.execute(update_query_stock_prices, (symbol, price, datetime.now()))
        conn.commit()

        print(f"Price for stock symbol '{symbol}' updated to {price}.")

    except mysql.connector.Error as e:
        print(f"Error: {e}")
    finally:
        cursor.close()  # Ensure the cursor is closed after use

# Optional: Close the connection when done
def close_connection():
    global connection
    if connection is not None and connection.is_connected():
        connection.close()
        print("MySQL connection is closed.")

def on_message(ws, message):
    # Step 2: Parse the JSON string into a Python dictionary
    data = json.loads(message)
    if "data" in data and isinstance(data["data"], list) and len(data["data"]) > 0:
        trade_info = data["data"][0]
        update_stock_price(trade_info["s"], trade_info["p"])
        print(f'Updated stock: {trade_info["s"]} with the price: {trade_info["p"]}$')

def on_error(ws, error):
    print(error)

def on_close(ws):
    print("### closed ###")
    close_connection()  # Ensure the database connection is closed when WebSocket closes

def on_open(ws):
    # Subscribe to multiple stock symbols
    symbols = ["AAPL", "AMZN", "GOOGL"]
    for symbol in symbols:
        ws.send(json.dumps({"type": "subscribe", "symbol": symbol}))

if __name__ == "__main__":
    print(os.environ.get("PYTHON_STOCK_API"))
    websocket.enableTrace(True)
    ws = websocket.WebSocketApp(os.environ.get("PYTHON_STOCK_API"),
                              on_message=on_message,
                              on_error=on_error,
                              on_close=on_close)
    ws.on_open = on_open
    ws.run_forever()
