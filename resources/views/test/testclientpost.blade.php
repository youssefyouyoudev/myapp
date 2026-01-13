{{-- filepath: c:\Users\youssef\Desktop\myapp\resources\views\api-tester.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Tester</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        form { margin-bottom: 2em; padding: 1em; border: 1px solid #ccc; }
        .error { color: red; }
        .response { background: #f8f8f8; padding: 1em; margin-top: 1em; border: 1px solid #eee; }
    </style>
</head>
<body>
    <h1>API Tester</h1>

    <form id="login-form">
        <h2>Login</h2>
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <div class="error" id="login-error"></div>
        <div class="response" id="login-response"></div>
    </form>

    <form id="client-create-form">
        <h2>Create Client</h2>
        <input type="number" name="user_id" placeholder="User ID" required>
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="text" name="status" placeholder="Status (active/suspended)" required>
        <input type="text" name="cin" placeholder="CIN" required>
        <input type="date" name="date_of_birth" placeholder="Date of Birth" required>
        <input type="text" name="school" placeholder="School" required>
        <button type="submit">Create</button>
        <div class="error" id="client-create-error"></div>
        <div class="response" id="client-create-response"></div>
    </form>

    <form id="client-list-form">
        <h2>List Clients</h2>
        <button type="submit">List</button>
        <div class="error" id="client-list-error"></div>
        <div class="response" id="client-list-response"></div>
    </form>

    <form id="logout-form">
        <h2>Logout</h2>
        <button type="submit">Logout</button>
        <div class="error" id="logout-error"></div>
        <div class="response" id="logout-response"></div>
    </form>

    <script>
          let token = '2|lEMBqHQYwXwnBs81LDvt3sY7cYj23MjrAmmf1ROE6010f12d';
        localStorage.setItem('api_token', token);

        function setToken(newToken) {
            token = newToken;
            localStorage.setItem('api_token', token);
        }
        function getToken() {
            return token || localStorage.getItem('api_token') || '';
        }


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

        document.getElementById('client-create-form').onsubmit = async function(e) {
            e.preventDefault();
            const form = e.target;
            const data = {
                user_id: form.user_id.value,
                full_name: form.full_name.value,
                phone: form.phone.value,
                status: form.status.value,
                cin: form.cin.value,
                date_of_birth: form.date_of_birth.value,
                school: form.school.value
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

        document.getElementById('logout-form').onsubmit = async function(e) {
            e.preventDefault();
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
                    document.getElementById('logout-response').innerText = JSON.stringify(json, null, 2);
                    document.getElementById('logout-error').innerText = '';
                    setToken('');
                } else {
                    document.getElementById('logout-error').innerText = JSON.stringify(json, null, 2);
                }
            } catch (err) {
                document.getElementById('logout-error').innerText = err;
            }
        };
    </script>
</body>
</html>
