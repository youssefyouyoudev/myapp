<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User CRUD API Tester</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        h1 { margin-bottom: 1em; }
        .route-block { border: 1px solid #ccc; padding: 1em; margin-bottom: 2em; border-radius: 8px; }
        .route-block h2 { margin-top: 0; }
        .error { color: red; }
        .response { background: #f8f8f8; padding: 1em; margin-top: 1em; border: 1px solid #eee; white-space: pre-wrap; }
        label { display: block; margin-top: 0.5em; }
        input, select, textarea { margin-bottom: 0.5em; width: 100%; padding: 0.5em; }
        button { padding: 0.5em 1em; }
    </style>
</head>
<body>
    <h1>User CRUD API Tester</h1>
    <div class="route-block">
        <h2>Login (Get Token)</h2>
        <form id="login-form">
            <label>Email: <input type="email" name="email" required></label>
            <label>Password: <input type="password" name="password" required></label>
            <button type="submit">Login</button>
            <div class="error" id="login-error"></div>
            <div class="response" id="login-response"></div>
        </form>
        <div>Current Token: <span id="current-token"></span></div>
        <button id="logout-btn">Logout</button>
    </div>
    <div class="route-block">
        <h2>Create User</h2>
        <form id="user-create-form">
            <label>Name: <input type="text" name="name" required></label>
            <label>Email: <input type="email" name="email" required></label>
            <label>Password: <input type="password" name="password" required></label>
            <label>Role:
                <select name="role" required>
                    <option value="admin">admin</option>
                    <option value="agent">agent</option>
                </select>
            </label>
            <button type="submit">Create</button>
            <div class="error" id="user-create-error"></div>
            <div class="response" id="user-create-response"></div>
        </form>
    </div>
    <div class="route-block">
        <h2>List Users</h2>
        <form id="user-list-form">
            <button type="submit">List Users</button>
            <div class="error" id="user-list-error"></div>
            <div class="response" id="user-list-response"></div>
        </form>
    </div>
    <div class="route-block">
        <h2>Show User</h2>
        <form id="user-show-form">
            <label>User ID: <input type="number" name="id" required></label>
            <button type="submit">Show User</button>
            <div class="error" id="user-show-error"></div>
            <div class="response" id="user-show-response"></div>
        </form>
    </div>
    <div class="route-block">
        <h2>Update User</h2>
        <form id="user-update-form">
            <label>User ID: <input type="number" name="id" required></label>
            <label>Name: <input type="text" name="name"></label>
            <label>Email: <input type="email" name="email"></label>
            <label>Password: <input type="password" name="password"></label>
            <label>Role:
                <select name="role">
                    <option value="">--</option>
                    <option value="admin">admin</option>
                    <option value="agent">agent</option>
                </select>
            </label>
            <button type="submit">Update User</button>
            <div class="error" id="user-update-error"></div>
            <div class="response" id="user-update-response"></div>
        </form>
    </div>
    <div class="route-block">
        <h2>Delete User</h2>
        <form id="user-delete-form">
            <label>User ID: <input type="number" name="id" required></label>
            <button type="submit">Delete User</button>
            <div class="error" id="user-delete-error"></div>
            <div class="response" id="user-delete-response"></div>
        </form>
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
                const res = await fetch('http://localhost:8000/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                if (json.token) {
                    setToken(json.token);
                    document.getElementById('login-error').innerText = '';
                } else {
                    document.getElementById('login-error').innerText = json.message || 'Login failed';
                }
                document.getElementById('login-response').innerText = JSON.stringify(json, null, 2);
            } catch (err) {
                document.getElementById('login-error').innerText = err.message;
            }
        };
        document.getElementById('logout-btn').onclick = function() {
            setToken('');
        };

        // Create User
        document.getElementById('user-create-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const data = {
                name: f.name.value,
                email: f.email.value,
                password: f.password.value,
                role: f.role.value
            };
            try {
                const res = await fetch('http://localhost:8000/api/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                document.getElementById('user-create-error').innerText = json.success ? '' : (json.message || 'Error');
                document.getElementById('user-create-response').innerText = JSON.stringify(json, null, 2);
            } catch (err) {
                document.getElementById('user-create-error').innerText = err.message;
            }
        };

        // List Users
        document.getElementById('user-list-form').onsubmit = async function(e) {
            e.preventDefault();
            try {
                const res = await fetch('http://localhost:8000/api/users', {
                    headers: { 'Authorization': 'Bearer ' + getToken() }
                });
                const json = await res.json();
                document.getElementById('user-list-error').innerText = json.success ? '' : (json.message || 'Error');
                document.getElementById('user-list-response').innerText = JSON.stringify(json, null, 2);
            } catch (err) {
                document.getElementById('user-list-error').innerText = err.message;
            }
        };

        // Show User
        document.getElementById('user-show-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch('http://localhost:8000/api/users/' + id, {
                    headers: { 'Authorization': 'Bearer ' + getToken() }
                });
                const json = await res.json();
                document.getElementById('user-show-error').innerText = json.success ? '' : (json.message || 'Error');
                document.getElementById('user-show-response').innerText = JSON.stringify(json, null, 2);
            } catch (err) {
                document.getElementById('user-show-error').innerText = err.message;
            }
        };

        // Update User
        document.getElementById('user-update-form').onsubmit = async function(e) {
            e.preventDefault();
            const f = e.target;
            const id = f.id.value;
            const data = {};
            ['name','email','password','role'].forEach(k => { if(f[k].value) data[k]=f[k].value; });
            try {
                const res = await fetch('http://localhost:8000/api/users/' + id, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                document.getElementById('user-update-error').innerText = json.success ? '' : (json.message || 'Error');
                document.getElementById('user-update-response').innerText = JSON.stringify(json, null, 2);
            } catch (err) {
                document.getElementById('user-update-error').innerText = err.message;
            }
        };

        // Delete User
        document.getElementById('user-delete-form').onsubmit = async function(e) {
            e.preventDefault();
            const id = e.target.id.value;
            try {
                const res = await fetch('http://localhost:8000/api/users/' + id, {
                    method: 'DELETE',
                    headers: { 'Authorization': 'Bearer ' + getToken() }
                });
                const json = await res.json();
                document.getElementById('user-delete-error').innerText = json.success ? '' : (json.message || 'Error');
                document.getElementById('user-delete-response').innerText = JSON.stringify(json, null, 2);
            } catch (err) {
                document.getElementById('user-delete-error').innerText = err.message;
            }
        };
    </script>
</body>
</html>
