import React, { useState, useEffect } from 'react';
import AsyncSelect from 'react-select/async';
import axios from 'axios';

function BuyStock() {
    const [ownedStocks, setOwnedStocks] = useState([]);
    const [auth, setAuth] = useState(false);
    const [showModal, setShowModal] = useState(false);
    const [quantity, setQuantity] = useState(1);
    const [selectedStock, setSelectedStock] = useState(null);
    const [message, setMessage] = useState('');
    const [imageURL, setImageURL] = useState('');
    const [showLogin, setShowLogin] = useState(true);

    // Check authentication and fetch owned stocks
    useEffect(() => {
        const checkAuthentication = async () => {
            try {
                const response = await axios.get('/api/user', {
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
                });

                if (response.status === 200) {
                    setAuth(true);
                    setShowLogin(false);
                    fetchOwnedStocks();
                }
            } catch (error) {
                console.error('Authentication failed:', error);
                setAuth(false);
                setShowLogin(true);
            }
        };

        checkAuthentication();
    }, []);

    const fetchOwnedStocks = async () => {
        try {
            const response = await axios.get('/api/owned-stocks', {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            });
            setOwnedStocks(response.data);
        } catch (error) {
            console.error('Failed to fetch owned stocks:', error);
            setMessage('Failed to fetch owned stocks.');
        }
    };

    const loadOptions = async (inputValue) => {
        if (inputValue.length < 3) return [];
        try {
            const response = await axios.get(`/api/search-stocks?query=${inputValue}`, {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            });

            return response.data.map((stock) => ({
                value: stock.id,
                label: `${stock.stock_name} (${stock.stock_symbol}) - $${stock.current_price}`,
                stock,
            }));
        } catch (error) {
            console.error('Failed to fetch search results:', error);
            return [];
        }
    };

    const handleSelectStock = (option) => {
        setSelectedStock(option ? option.stock : null);
    };

    const handleBuyStock = async (e) => {
        e.preventDefault();
        if (!selectedStock) {
            setMessage('Please select a stock to purchase.');
            return;
        }

        try {
            const response = await axios.post(
                '/api/buy-stock',
                { stock_id: selectedStock.stock_id, quantity },
                { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } }
            );

            setMessage(response.data.message);
            fetchOwnedStocks();
            setShowModal(false);
            setSelectedStock(null);
            setQuantity(1);
        } catch (error) {
            console.error('Failed to purchase stock:', error);
            setMessage('Failed to purchase stock. Please try again.');
        }
    };

    const handleUpdateImageUrl = async (stockId, newImageUrl) => {
        try {
            const response = await axios.post(
                '/api/update-stock-image-url',
                { stock_id: stockId, image_url: newImageUrl },
                { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } }
            );

            setMessage(response.data.message);
            fetchOwnedStocks();
        } catch (error) {
            console.error('Failed to update stock image URL:', error);
            setMessage('Failed to update stock image URL. Please try again.');
        }
    };

    const handleSellStock = async (stockId, quantityToSell) => {
        try {
            const response = await axios.post(
                '/api/sell-stock',
                { stock_id: stockId, quantity: quantityToSell },
                { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } }
            );

            setMessage(response.data.message);
            fetchOwnedStocks();
        } catch (error) {
            console.error('Failed to sell stock:', error);
            setMessage('Failed to sell stock. Please try again.');
        }
    };

    const handleLogin = async (e) => {
        e.preventDefault();
        const { email, password } = e.target.elements;

        try {
            const response = await axios.post('/api/login', {
                email: email.value,
                password: password.value,
            });

            localStorage.setItem('token', response.data.token);
            setAuth(true);
            setShowLogin(false);
            fetchOwnedStocks();
            setMessage('Login successful!');
        } catch (error) {
            console.error('Login failed:', error);
            setMessage('Failed to log in. Please check your credentials.');
        }
    };

    const totalPrice = selectedStock ? selectedStock.current_price * quantity : 0;

    return (
        <div className="container mt-4">
            <header className="mb-4">
                <h2>Stock Portfolio Management</h2>
                {auth && (
                    <button
                        className="btn btn-secondary"
                        onClick={() => {
                            localStorage.removeItem('token');
                            setAuth(false);
                            setOwnedStocks([]);
                            setShowLogin(true);
                            setMessage('Logged out successfully.');
                        }}
                    >
                        Logout
                    </button>
                )}
            </header>

            {message && <div className="alert alert-info">{message}</div>}

            {showLogin ? (
                <div className="login-form">
                    <h4>Login</h4>
                    <form onSubmit={handleLogin}>
                        <input
                            type="email"
                            name="email"
                            placeholder="Email"
                            className="form-control mb-3"
                            required
                        />
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            className="form-control mb-3"
                            required
                        />
                        <button type="submit" className="btn btn-primary">
                            Login
                        </button>
                    </form>
                </div>
            ) : (
                <>
                    <h4>Owned Stocks</h4>
                    <ul className="list-group mb-4">
                        {ownedStocks.map((stock) => (
                            <li key={stock.id} className="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img
                                        src={stock.image_url ? stock.image_url : 'https://via.placeholder.com/50'}
                                        alt={stock.stock_name || 'Stock Image'}
                                        style={{ width: 50, height: 50, marginRight: 10 }}
                                        onError={(e) => {
                                            e.target.onerror = null; // Prevent infinite loop
                                            e.target.src = 'https://via.placeholder.com/50';
                                        }}
                                    />
                                    {stock.stock_name} ({stock.stock_symbol}) - Qty: {stock.quantity}
                                </div>
                                <div>
                                    <input
                                        type="text"
                                        placeholder="Update Image URL"
                                        className="form-control mb-2"
                                        onChange={(e) => setImageURL(e.target.value)}
                                    />
                                    <button
                                        className="btn btn-primary mb-2"
                                        onClick={() => handleUpdateImageUrl(stock.stock_id, imageURL)}
                                    >
                                        Update Image
                                    </button>
                                    <button
                                        className="btn btn-danger"
                                        onClick={() => handleSellStock(stock.stock_id, 1)}
                                    >
                                        Sell 1
                                    </button>
                                </div>
                            </li>
                        ))}
                    </ul>
                    <button className="btn btn-primary mt-3" onClick={() => setShowModal(true)}>
                        Buy Stock
                    </button>

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
                                            {selectedStock && (
                                                <div className="mb-3">
                                                    <p>
                                                        <strong>Stock:</strong> {selectedStock.stock_name} ({selectedStock.stock_symbol})
                                                    </p>
                                                    <p>
                                                        <strong>Price:</strong> ${selectedStock.current_price}
                                                    </p>
                                                </div>
                                            )}
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
                                            <div className="mb-3">
                                                <p>
                                                    <strong>Total Price:</strong> ${totalPrice}
                                                </p>
                                            </div>
                                            <button type="submit" className="btn btn-primary">
                                                Confirm Purchase
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}
                </>
            )}
        </div>
    );
}

export default BuyStock;
