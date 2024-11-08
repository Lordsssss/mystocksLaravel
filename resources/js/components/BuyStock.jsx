import React, { useState, useEffect } from 'react';
import AsyncSelect from 'react-select/async'; // Import AsyncSelect
import axios from 'axios';

function BuyStock() {
    const [ownedStocks, setOwnedStocks] = useState([]);
    const [showModal, setShowModal] = useState(false);
    const [quantity, setQuantity] = useState(1);
    const [selectedStock, setSelectedStock] = useState(null);
    const [message, setMessage] = useState('');

    // Fetch owned stocks when the component mounts
    useEffect(() => {
        fetchOwnedStocks();
    }, []);

    // Function to fetch owned stocks from the backend
    const fetchOwnedStocks = async () => {
        try {
            const response = await axios.get('/api/owned-stocks', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            setOwnedStocks(response.data);
        } catch (error) {
            console.error('Failed to fetch owned stocks:', error);
        }
    };

    // Function to load options for AsyncSelect
    const loadOptions = async (inputValue) => {
        if (inputValue.length < 3) return []; // Only search if input is 3+ characters

        try {
            const response = await axios.get(`/api/search-stocks?query=${inputValue}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });

            // Map results to options for react-select
            return response.data.map(stock => ({
                value: stock.id,
                label: `${stock.stock_name} (${stock.stock_symbol}) - $${stock.current_price}`,
                stock: stock
            }));
        } catch (error) {
            console.error('Failed to fetch search results:', error);
            return [];
        }
    };

    // Handle selecting a stock
    const handleSelectStock = (option) => {
        setSelectedStock(option ? option.stock : null);
    };

    // Handle the buy stock form submission
    const handleBuyStock = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('/api/buy-stock', {
                stock_id: selectedStock.stock_id,
                quantity: quantity,
            }, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });

            setMessage(response.data.message);
            fetchOwnedStocks(); // Refresh the owned stocks list
            setShowModal(false); // Close the modal
            setSelectedStock(null); // Reset selection
            setQuantity(1); // Reset quantity
        } catch (error) {
            console.log(error)
            setMessage('Failed to purchase stock. Please try again.');
        }
    };

    // Calculate total price
    const totalPrice = selectedStock ? (selectedStock.current_price * quantity) : 0;

    return (
        <div className="container mt-4">
            <h2 className="text-center mb-4">My Portfolio</h2>

            {/* Message Display */}
            {message && <div className="alert alert-info">{message}</div>}

            {/* Owned Stocks List */}
            <div className="mb-4">
                <h4>Currently Owned Stocks</h4>
                <ul className="list-group">
                    {ownedStocks.length > 0 ? (
                        ownedStocks.map(stock => (
                            <li key={stock.id} className="list-group-item d-flex justify-content-between align-items-center">
                                <span>{stock.stock_symbol}</span>
                                <span>{stock.stock_name}</span>
                                <span>Quantity: {stock.quantity}</span>
                            </li>
                        ))
                    ) : (
                        <li className="list-group-item">You don't own any stocks yet.</li>
                    )}
                </ul>
            </div>

            {/* Buy Stock Button */}
            <button className="btn btn-primary" onClick={() => setShowModal(true)}>
                Buy Stock
            </button>

            {/* Modal for Buying Stock */}
            {showModal && (
                <div className="modal fade show d-block" style={{ backgroundColor: 'rgba(0, 0, 0, 0.5)' }}>
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title">Buy Stock</h5>
                                <button type="button" className="close" onClick={() => setShowModal(false)}>
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div className="modal-body">
                                <form onSubmit={handleBuyStock}>
                                    {/* Stock Search Auto-complete */}
                                    <div className="form-group">
                                        <label>Search Stock</label>
                                        <AsyncSelect
                                            cacheOptions
                                            loadOptions={loadOptions}
                                            onChange={handleSelectStock}
                                            placeholder="Type stock name or symbol"
                                            isClearable
                                        />
                                    </div>

                                    {/* Display Selected Stock Info */}
                                    {selectedStock && (
                                        <div className="mb-3">
                                            <p><strong>Stock:</strong> {selectedStock.stock_name} ({selectedStock.stock_symbol})</p>
                                            <p><strong>Price:</strong> ${selectedStock.current_price}</p>
                                        </div>
                                    )}

                                    {/* Quantity Input */}
                                    <div className="form-group">
                                        <label>Quantity</label>
                                        <input
                                            type="number"
                                            className="form-control"
                                            value={quantity}
                                            onChange={(e) => setQuantity(e.target.value)}
                                            min="1"
                                            required
                                        />
                                    </div>

                                    {/* Total Price Display */}
                                    <div className="mb-3">
                                        <p><strong>Total Price:</strong> ${totalPrice}</p>
                                    </div>

                                    <button type="submit" className="btn btn-primary">Confirm Purchase</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}

export default BuyStock;
