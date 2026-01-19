<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Tester</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        h1 { margin-bottom: 1em; }
        .route-block { border: 1px solid #ccc; padding: 1em; margin-bottom: 2em; border-radius: 8px; }
        .route-block h2 { margin-top: 0; }
        .error { color: red; }
        .response { background: #f8f8f8; padding: 1em; margin-top: 1em; border: 1px solid #eee; white-space: pre-wrap; }
        .token-block { margin-bottom: 2em; }
        label { display: block; margin-top: 0.5em; }
        input, select, textarea { margin-bottom: 0.5em; width: 100%; padding: 0.5em; }
        button { padding: 0.5em 1em; }
        .flex-row { display: flex; gap: 1em; }
        .flex-col { flex: 1; }
    </style>
</head>
<body>
    <h1>Laravel API Tester</h1>
    <div class="token-block">
        <form id="login-form">
            <h2>Login</h2>
            <label>Email: <input type="text" name="email" required></label>
            <label>Password: <input type="password" name="password" required></label>
            <button type="submit">Login</button>
            <div class="error" id="login-error"></div>
            <div class="response" id="login-response"></div>
        </form>
        <button id="logout-btn">Logout</button>
        <div>Current Token: <span id="current-token"></span></div>
    </div>


    <!-- CRUD Forms for Each Controller -->

    <div class="route-block">
        <h2>Subscription Plans CRUD</h2>
        <form id="subscription-plan-create-form">
            <h3>Create Subscription Plan</h3>
            <label>Name: <input type="text" name="name" required></label>
            <label>Price: <input type="number" name="price" required></label>
            <label>Type: <input type="text" name="type" placeholder="monthly,2_month,3_month,yearly" required></label>
            <button type="submit">Create</button>
            <div class="error" id="subscription-plan-create-error"></div>
            <div class="response" id="subscription-plan-create-response"></div>
        </form>
        <form id="subscription-plan-list-form">
            <h3>List Subscription Plans</h3>
            <button type="submit">List</button>
            <div class="error" id="subscription-plan-list-error"></div>
            <div class="response" id="subscription-plan-list-response"></div>
        </form>
        <form id="subscription-plan-show-form">
            <h3>Show Subscription Plan</h3>
            <label>Plan ID: <input type="number" name="id" required></label>
            <button type="submit">Show</button>
            <div class="error" id="subscription-plan-show-error"></div>
            <div class="response" id="subscription-plan-show-response"></div>
        </form>
        <form id="subscription-plan-update-form">
            <h3>Update Subscription Plan</h3>
            <label>Plan ID: <input type="number" name="id" required></label>
            <label>Name: <input type="text" name="name"></label>
            <label>Price: <input type="number" name="price"></label>
            <label>Type: <input type="text" name="type" placeholder="monthly,2_month,3_month,yearly"></label>
            <button type="submit">Update</button>
            <div class="error" id="subscription-plan-update-error"></div>
            <div class="response" id="subscription-plan-update-response"></div>
        </form>
        <form id="subscription-plan-delete-form">
            <h3>Delete Subscription Plan</h3>
            <label>Plan ID: <input type="number" name="id" required></label>
            <button type="submit">Delete</button>
            <div class="error" id="subscription-plan-delete-error"></div>
            <div class="response" id="subscription-plan-delete-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Voyage Plans CRUD</h2>
        <form id="voyage-plan-create-form">
            <h3>Create Voyage Plan</h3>
            <label>Price: <input type="number" name="price" required></label>
            <label>Number of Voyages: <input type="number" name="number_of_voyages" required></label>
            <label>Expiration: <input type="text" name="expiration" placeholder="6_month,1_year" required></label>
            <button type="submit">Create</button>
            <div class="error" id="voyage-plan-create-error"></div>
            <div class="response" id="voyage-plan-create-response"></div>
        </form>
        <form id="voyage-plan-list-form">
            <h3>List Voyage Plans</h3>
            <button type="submit">List</button>
            <div class="error" id="voyage-plan-list-error"></div>
            <div class="response" id="voyage-plan-list-response"></div>
        </form>
        <form id="voyage-plan-show-form">
            <h3>Show Voyage Plan</h3>
            <label>Plan ID: <input type="number" name="id" required></label>
            <button type="submit">Show</button>
            <div class="error" id="voyage-plan-show-error"></div>
            <div class="response" id="voyage-plan-show-response"></div>
        </form>
        <form id="voyage-plan-update-form">
            <h3>Update Voyage Plan</h3>
            <label>Plan ID: <input type="number" name="id" required></label>
            <label>Price: <input type="number" name="price"></label>
            <label>Number of Voyages: <input type="number" name="number_of_voyages"></label>
            <label>Expiration: <input type="text" name="expiration" placeholder="6_month,1_year"></label>
            <button type="submit">Update</button>
            <div class="error" id="voyage-plan-update-error"></div>
            <div class="response" id="voyage-plan-update-response"></div>
        </form>
        <form id="voyage-plan-delete-form">
            <h3>Delete Voyage Plan</h3>
            <label>Plan ID: <input type="number" name="id" required></label>
            <button type="submit">Delete</button>
            <div class="error" id="voyage-plan-delete-error"></div>
            <div class="response" id="voyage-plan-delete-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Card Actions</h2>
        <form id="card-scan-form">
            <h3>Scan Card (NFC)</h3>
            <label>NFC UID: <input type="text" name="nfc_uid" required></label>
            <button type="submit">Scan</button>
            <div class="error" id="card-scan-error"></div>
            <div class="response" id="card-scan-response"></div>
        </form>
        <form id="card-link-form">
            <h3>Link Card to Client</h3>
            <label>Card ID: <input type="number" name="card_id" required></label>
            <label>Client ID: <input type="number" name="client_id" required></label>
            <button type="submit">Link</button>
            <div class="error" id="card-link-error"></div>
            <div class="response" id="card-link-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Charging Actions</h2>
        <form id="charge-subscription-form">
            <h3>Charge Subscription</h3>
            <label>Client ID: <input type="number" name="client_id" required></label>
            <label>Subscription Plan ID: <input type="number" name="subscription_plan_id" required></label>
            <button type="submit">Charge Subscription</button>
            <div class="error" id="charge-subscription-error"></div>
            <div class="response" id="charge-subscription-response"></div>
        </form>
        <form id="charge-voyage-form">
            <h3>Charge Voyage</h3>
            <label>Client ID: <input type="number" name="client_id" required></label>
            <label>Voyage Plan ID: <input type="number" name="voyage_plan_id" required></label>
            <button type="submit">Charge Voyage</button>
            <div class="error" id="charge-voyage-error"></div>
            <div class="response" id="charge-voyage-response"></div>
        </form>
    </div>
    <div class="route-block">
        <h2>Clients CRUD</h2>
        <form id="client-create-form">
            <h3>Create Client</h3>
            <label>User ID: <input type="number" name="user_id" required></label>
            <label>Full Name: <input type="text" name="full_name" required></label>
            <label>Phone: <input type="text" name="phone" required></label>
            <label>Status: <input type="text" name="status" required></label>
            <label>CIN: <input type="text" name="cin" required></label>
            <label>Date of Birth: <input type="date" name="date_of_birth" required></label>
            <label>School: <input type="text" name="school" required></label>
            <button type="submit">Create</button>
            <div class="error" id="client-create-error"></div>
            <div class="response" id="client-create-response"></div>
        </form>
        <form id="client-list-form">
            <h3>List Clients</h3>
            <button type="submit">List</button>
            <div class="error" id="client-list-error"></div>
            <div class="response" id="client-list-response"></div>
        </form>
        <form id="client-show-form">
            <h3>Show Client</h3>
            <label>Client ID: <input type="number" name="id" required></label>
            <button type="submit">Show</button>
            <div class="error" id="client-show-error"></div>
            <div class="response" id="client-show-response"></div>
        </form>
        <form id="client-update-form">
            <h3>Update Client</h3>
            <label>Client ID: <input type="number" name="id" required></label>
            <label>User ID: <input type="number" name="user_id"></label>
            <label>Full Name: <input type="text" name="full_name"></label>
            <label>Phone: <input type="text" name="phone"></label>
            <label>Status: <input type="text" name="status"></label>
            <label>CIN: <input type="text" name="cin"></label>
            <label>Date of Birth: <input type="date" name="date_of_birth"></label>
            <label>School: <input type="text" name="school"></label>
            <button type="submit">Update</button>
            <div class="error" id="client-update-error"></div>
            <div class="response" id="client-update-response"></div>
        </form>
        <form id="client-delete-form">
            <h3>Delete Client</h3>
            <label>Client ID: <input type="number" name="id" required></label>
            <button type="submit">Delete</button>
            <div class="error" id="client-delete-error"></div>
            <div class="response" id="client-delete-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Cards CRUD</h2>
        <form id="card-create-form">
            <h3>Create Card</h3>
            <label>Client ID: <input type="number" name="client_id" required></label>
            <label>Serial: <input type="text" name="serial" required></label>
            <label>Status: <input type="text" name="status" required></label>
            <button type="submit">Create</button>
            <div class="error" id="card-create-error"></div>
            <div class="response" id="card-create-response"></div>
        </form>
        <form id="card-list-form">
            <h3>List Cards</h3>
            <button type="submit">List</button>
            <div class="error" id="card-list-error"></div>
            <div class="response" id="card-list-response"></div>
        </form>
        <form id="card-show-form">
            <h3>Show Card</h3>
            <label>Card ID: <input type="number" name="id" required></label>
            <button type="submit">Show</button>
            <div class="error" id="card-show-error"></div>
            <div class="response" id="card-show-response"></div>
        </form>
        <form id="card-update-form">
            <h3>Update Card</h3>
            <label>Card ID: <input type="number" name="id" required></label>
            <label>Client ID: <input type="number" name="client_id"></label>
            <label>Serial: <input type="text" name="serial"></label>
            <label>Status: <input type="text" name="status"></label>
            <button type="submit">Update</button>
            <div class="error" id="card-update-error"></div>
            <div class="response" id="card-update-response"></div>
        </form>
        <form id="card-delete-form">
            <h3>Delete Card</h3>
            <label>Card ID: <input type="number" name="id" required></label>
            <button type="submit">Delete</button>
            <div class="error" id="card-delete-error"></div>
            <div class="response" id="card-delete-response"></div>
        </form>
        <form id="card-block-form">
            <h3>Block Card</h3>
            <label>Card ID: <input type="number" name="id" required></label>
            <button type="submit">Block</button>
            <div class="error" id="card-block-error"></div>
            <div class="response" id="card-block-response"></div>
        </form>
        <form id="card-unblock-form">
            <h3>Unblock Card</h3>
            <label>Card ID: <input type="number" name="id" required></label>
            <button type="submit">Unblock</button>
            <div class="error" id="card-unblock-error"></div>
            <div class="response" id="card-unblock-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Voyages CRUD</h2>
        <form id="voyage-create-form">
            <h3>Create Voyage</h3>
            <label>Card ID: <input type="number" name="card_id" required></label>
            <label>Client ID: <input type="number" name="client_id" required></label>
            <label>Timestamp: <input type="datetime-local" name="timestamp" required></label>
            <button type="submit">Create</button>
            <div class="error" id="voyage-create-error"></div>
            <div class="response" id="voyage-create-response"></div>
        </form>
        <form id="voyage-list-form">
            <h3>List Voyages</h3>
            <button type="submit">List</button>
            <div class="error" id="voyage-list-error"></div>
            <div class="response" id="voyage-list-response"></div>
        </form>
        <form id="voyage-show-form">
            <h3>Show Voyage</h3>
            <label>Voyage ID: <input type="number" name="id" required></label>
            <button type="submit">Show</button>
            <div class="error" id="voyage-show-error"></div>
            <div class="response" id="voyage-show-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Payments CRUD</h2>
        <form id="payment-create-form">
            <h3>Create Payment</h3>
            <label>Card ID: <input type="number" name="card_id" required></label>
            <label>Amount: <input type="number" name="amount" required></label>
            <button type="submit">Create</button>
            <div class="error" id="payment-create-error"></div>
            <div class="response" id="payment-create-response"></div>
        </form>
        <form id="payment-list-form">
            <h3>List Payments</h3>
            <button type="submit">List</button>
            <div class="error" id="payment-list-error"></div>
            <div class="response" id="payment-list-response"></div>
        </form>
        <form id="payment-show-form">
            <h3>Show Payment</h3>
            <label>Payment ID: <input type="number" name="id" required></label>
            <button type="submit">Show</button>
            <div class="error" id="payment-show-error"></div>
            <div class="response" id="payment-show-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Subscriptions CRUD</h2>
        <form id="subscription-create-form">
            <h3>Create Subscription</h3>
            <label>Client ID: <input type="number" name="client_id" required></label>
            <label>Type: <input type="text" name="type" required></label>
            <label>Start Date: <input type="date" name="start_date" required></label>
            <label>End Date: <input type="date" name="end_date" required></label>
            <button type="submit">Create</button>
            <div class="error" id="subscription-create-error"></div>
            <div class="response" id="subscription-create-response"></div>
        </form>
        <form id="subscription-list-form">
            <h3>List Subscriptions</h3>
            <button type="submit">List</button>
            <div class="error" id="subscription-list-error"></div>
            <div class="response" id="subscription-list-response"></div>
        </form>
        <form id="subscription-show-form">
            <h3>Show Subscription</h3>
            <label>Subscription ID: <input type="number" name="id" required></label>
            <button type="submit">Show</button>
            <div class="error" id="subscription-show-error"></div>
            <div class="response" id="subscription-show-response"></div>
        </form>
        <form id="subscription-update-form">
            <h3>Update Subscription</h3>
            <label>Subscription ID: <input type="number" name="id" required></label>
            <label>Client ID: <input type="number" name="client_id"></label>
            <label>Type: <input type="text" name="type"></label>
            <label>Start Date: <input type="date" name="start_date"></label>
            <label>End Date: <input type="date" name="end_date"></label>
            <button type="submit">Update</button>
            <div class="error" id="subscription-update-error"></div>
            <div class="response" id="subscription-update-response"></div>
        </form>
        <form id="subscription-delete-form">
            <h3>Delete Subscription</h3>
            <label>Subscription ID: <input type="number" name="id" required></label>
            <button type="submit">Delete</button>
            <div class="error" id="subscription-delete-error"></div>
            <div class="response" id="subscription-delete-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Users</h2>
        <form id="user-list-form">
            <h3>List Users</h3>
            <button type="submit">List</button>
            <div class="error" id="user-list-error"></div>
            <div class="response" id="user-list-response"></div>
        </form>
        <form id="user-stats-form">
            <h3>My Stats</h3>
            <button type="submit">Get My Stats</button>
            <div class="error" id="user-stats-error"></div>
            <div class="response" id="user-stats-response"></div>
        </form>
    </div>

    <div class="route-block">
        <h2>Quick Test: Common Endpoints</h2>
        <div class="flex-row">
            <div class="flex-col">
                <button onclick="quickTest('GET', '/api/me')">GET /api/me</button>
                <button onclick="quickTest('GET', '/api/users/me/stats')">GET /api/users/me/stats</button>
                <button onclick="quickTest('GET', '/api/users')">GET /api/users</button>
                <button onclick="quickTest('GET', '/api/dashboard')">GET /api/dashboard</button>
            </div>
            <div class="flex-col">
                <button onclick="quickTest('GET', '/api/clients')">GET /api/clients</button>
                <button onclick="quickTest('POST', '/api/clients', '{\"user_id\":1,\"full_name\":\"Test User\",\"phone\":\"123456\",\"status\":\"active\",\"cin\":\"CIN123\",\"date_of_birth\":\"2000-01-01\",\"school\":\"Test School\"}')">POST /api/clients</button>
                <button onclick="quickTest('GET', '/api/cards')">GET /api/cards</button>
                <button onclick="quickTest('GET', '/api/voyages')">GET /api/voyages</button>
            </div>
            <div class="flex-col">
                <button onclick="quickTest('GET', '/api/payments')">GET /api/payments</button>
                <button onclick="quickTest('GET', '/api/subscriptions')">GET /api/subscriptions</button>
                <button onclick="quickTest('POST', '/api/cards/1/block')">POST /api/cards/1/block</button>
                <button onclick="quickTest('POST', '/api/cards/1/unblock')">POST /api/cards/1/unblock</button>
            </div>
        </div>
        <div class="error" id="quick-test-error"></div>
        <div class="response" id="quick-test-response"></div>
    </div>

    <script>
        // Token management
        function setToken(token) {
            localStorage.setItem('api_token', token);
            document.getElementById('current-token').innerText = token;
        }
        function getToken() {
            return localStorage.getItem('api_token') || '';
        }
        setToken(getToken());

        // Login
        document.getElementById('login-form').onsubmit = async function(e) {
            e.preventDefault();
            const form = e.target;
            const data = {
                email: form.email.value,
                password: form.password.value
            };
            try {
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (json.token) {
                    setToken(json.token);
                    document.getElementById('login-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('login-error').innerText = '';
                } else {
                    document.getElementById('login-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('login-error').innerText = err;
            }
        };

        // Logout
        document.getElementById('logout-btn').onclick = async function() {
            try {
                const res = await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    setToken('');
                    document.getElementById('login-response').innerText = '';
                    document.getElementById('current-token').innerText = '';
                }
                alert(JSON.stringify(json, null, 2));
            } catch (err) {
                alert(err);
            }
        };

        // CLIENTS CRUD
        document.getElementById('client-create-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const data = {
                user_id: f.user_id.value,
                full_name: f.full_name.value,
                phone: f.phone.value,
                status: f.status.value,
                cin: f.cin.value,
                date_of_birth: f.date_of_birth.value,
                school: f.school.value
            };
            try {
                const res = await fetch('/api/clients', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('client-create-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('client-create-error').innerText = '';
                } else {
                    document.getElementById('client-create-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('client-create-error').innerText = err;
            }
        };
        document.getElementById('client-list-form').onsubmit = async function(e) {
            e.preventDefault();
            try {
                const res = await fetch('/api/clients', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('client-list-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('client-list-error').innerText = '';
                } else {
                    document.getElementById('client-list-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('client-list-error').innerText = err;
            }
        };
        document.getElementById('client-show-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/clients/${id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('client-show-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('client-show-error').innerText = '';
                } else {
                    document.getElementById('client-show-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('client-show-error').innerText = err;
            }
        };
        document.getElementById('client-update-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const id = f.id.value;
            const data = {};
            ['user_id','full_name','phone','status','cin','date_of_birth','school'].forEach(k => { if(f[k].value) data[k]=f[k].value; });
            try {
                const res = await fetch(`/api/clients/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('client-update-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('client-update-error').innerText = '';
                } else {
                    document.getElementById('client-update-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('client-update-error').innerText = err;
            }
        };
        document.getElementById('client-delete-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/clients/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const text = await res.text();
                let json;
                try { json = JSON.parse(text); } catch { json = text; }
                if (res.ok) {
                    document.getElementById('client-delete-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('client-delete-error').innerText = '';
                } else {
                    document.getElementById('client-delete-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('client-delete-error').innerText = err;
            }
        };

        // CARDS CRUD
        document.getElementById('card-create-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const data = {
                client_id: f.client_id.value,
                serial: f.serial.value,
                status: f.status.value
            };
            try {
                const res = await fetch('/api/cards', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('card-create-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('card-create-error').innerText = '';
                } else {
                    document.getElementById('card-create-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('card-create-error').innerText = err;
            }
        };
        document.getElementById('card-list-form').onsubmit = async function(e) {
            e.preventDefault();
            try {
                const res = await fetch('/api/cards', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('card-list-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('card-list-error').innerText = '';
                } else {
                    document.getElementById('card-list-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('card-list-error').innerText = err;
            }
        };
        document.getElementById('card-show-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/cards/${id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('card-show-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('card-show-error').innerText = '';
                } else {
                    document.getElementById('card-show-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('card-show-error').innerText = err;
            }
        };
        document.getElementById('card-update-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const id = f.id.value;
            const data = {};
            ['client_id','serial','status'].forEach(k => { if(f[k].value) data[k]=f[k].value; });
            try {
                const res = await fetch(`/api/cards/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('card-update-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('card-update-error').innerText = '';
                } else {
                    document.getElementById('card-update-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('card-update-error').innerText = err;
            }
        };
        document.getElementById('card-delete-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/cards/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const text = await res.text();
                let json;
                try { json = JSON.parse(text); } catch { json = text; }
                if (res.ok) {
                    document.getElementById('card-delete-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('card-delete-error').innerText = '';
                } else {
                    document.getElementById('card-delete-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('card-delete-error').innerText = err;
            }
        };
        document.getElementById('card-block-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/cards/${id}/block`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('card-block-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('card-block-error').innerText = '';
                } else {
                    document.getElementById('card-block-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('card-block-error').innerText = err;
            }
        };
        document.getElementById('card-unblock-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/cards/${id}/unblock`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('card-unblock-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('card-unblock-error').innerText = '';
                } else {
                    document.getElementById('card-unblock-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('card-unblock-error').innerText = err;
            }
        };

        // VOYAGES CRUD
        document.getElementById('voyage-create-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const data = {
                card_id: f.card_id.value,
                client_id: f.client_id.value,
                timestamp: f.timestamp.value
            };
            try {
                const res = await fetch('/api/voyages', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('voyage-create-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('voyage-create-error').innerText = '';
                } else {
                    document.getElementById('voyage-create-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('voyage-create-error').innerText = err;
            }
        };
        document.getElementById('voyage-list-form').onsubmit = async function(e) {
            e.preventDefault();
            try {
                const res = await fetch('/api/voyages', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('voyage-list-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('voyage-list-error').innerText = '';
                } else {
                    document.getElementById('voyage-list-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('voyage-list-error').innerText = err;
            }
        };
        document.getElementById('voyage-show-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/voyages/${id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('voyage-show-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('voyage-show-error').innerText = '';
                } else {
                    document.getElementById('voyage-show-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('voyage-show-error').innerText = err;
            }
        };

        // PAYMENTS CRUD
        document.getElementById('payment-create-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const data = {
                card_id: f.card_id.value,
                amount: f.amount.value
            };
            try {
                const res = await fetch('/api/payments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('payment-create-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('payment-create-error').innerText = '';
                } else {
                    document.getElementById('payment-create-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('payment-create-error').innerText = err;
            }
        };
        document.getElementById('payment-list-form').onsubmit = async function(e) {
            e.preventDefault();
            try {
                const res = await fetch('/api/payments', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('payment-list-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('payment-list-error').innerText = '';
                } else {
                    document.getElementById('payment-list-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('payment-list-error').innerText = err;
            }
        };
        document.getElementById('payment-show-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/payments/${id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('payment-show-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('payment-show-error').innerText = '';
                } else {
                    document.getElementById('payment-show-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('payment-show-error').innerText = err;
            }
        };

        // SUBSCRIPTIONS CRUD
        document.getElementById('subscription-create-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const data = {
                client_id: f.client_id.value,
                type: f.type.value,
                start_date: f.start_date.value,
                end_date: f.end_date.value
            };
            try {
                const res = await fetch('/api/subscriptions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('subscription-create-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('subscription-create-error').innerText = '';
                } else {
                    document.getElementById('subscription-create-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('subscription-create-error').innerText = err;
            }
        };
        document.getElementById('subscription-list-form').onsubmit = async function(e) {
            e.preventDefault();
            try {
                const res = await fetch('/api/subscriptions', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('subscription-list-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('subscription-list-error').innerText = '';
                } else {
                    document.getElementById('subscription-list-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('subscription-list-error').innerText = err;
            }
        };
        document.getElementById('subscription-show-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/subscriptions/${id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('subscription-show-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('subscription-show-error').innerText = '';
                } else {
                    document.getElementById('subscription-show-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('subscription-show-error').innerText = err;
            }
        };
        document.getElementById('subscription-update-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const id = f.id.value;
            const data = {};
            ['client_id','type','start_date','end_date'].forEach(k => { if(f[k].value) data[k]=f[k].value; });
            try {
                const res = await fetch(`/api/subscriptions/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('subscription-update-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('subscription-update-error').innerText = '';
                } else {
                    document.getElementById('subscription-update-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('subscription-update-error').innerText = err;
            }
        };
        document.getElementById('subscription-delete-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch(`/api/subscriptions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const text = await res.text();
                let json;
                try { json = JSON.parse(text); } catch { json = text; }
                if (res.ok) {
                    document.getElementById('subscription-delete-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('subscription-delete-error').innerText = '';
                } else {
                    document.getElementById('subscription-delete-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('subscription-delete-error').innerText = err;
            }
        };

        // USERS
        document.getElementById('user-list-form').onsubmit = async function(e) {
            e.preventDefault();
            try {
                const res = await fetch('/api/users', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('user-list-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('user-list-error').innerText = '';
                } else {
                    document.getElementById('user-list-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('user-list-error').innerText = err;
            }
        };
        document.getElementById('user-stats-form').onsubmit = async function(e) {
            e.preventDefault();
            try {
                const res = await fetch('/api/users/me/stats', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    }
                });
                const json = await res.json();
                if (res.ok) {
                    document.getElementById('user-stats-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('user-stats-error').innerText = '';
                } else {
                    document.getElementById('user-stats-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('user-stats-error').innerText = err;
            }
        };
    </script>
</body>
</html>
