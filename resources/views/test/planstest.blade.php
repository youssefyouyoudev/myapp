<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Plans CRUD Tester</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
		body { font-family: Arial, sans-serif; margin: 2em; }
		h1 { margin-bottom: 1em; }
		.route-block { border: 1px solid #ccc; padding: 1em; margin-bottom: 2em; border-radius: 8px; }
		.route-block h2 { margin-top: 0; }
		.error { color: red; }
		.response { background: #f8f8f8; padding: 1em; margin-top: 1em; border: 1px solid #eee; white-space: pre-wrap; }
		label { display: block; margin-top: 0.5em; }
		input, select { margin-bottom: 0.5em; width: 100%; padding: 0.5em; }
		button { padding: 0.5em 1em; }
	</style>
</head>
<body>
	<h1>Plans CRUD Tester</h1>

	<div class="route-block">
		<h2>Subscription Plans CRUD</h2>
		<form id="subscription-plan-create-form">
			<h3>Create Subscription Plan</h3>
			<label>Name: <input type="text" name="name" required></label>
			<div class="error" id="spc-error-name"></div>
			<label>Price: <input type="number" name="price" required></label>
			<div class="error" id="spc-error-price"></div>
			<label>Type:
				<select name="type" required>
					<option value="">Select type</option>
					<option value="monthly">Monthly</option>
					<option value="2_month">2 Month</option>
					<option value="3_month">3 Month</option>
					<option value="yearly">Yearly</option>
				</select>
			</label>
			<div class="error" id="spc-error-type"></div>
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
		<form id="subscription-plan-update-form">
			<h3>Update Subscription Plan</h3>
			<label>Plan ID: <input type="number" name="id" required></label>
			<div class="error" id="spu-error-id"></div>
			<label>Name: <input type="text" name="name"></label>
			<div class="error" id="spu-error-name"></div>
			<label>Price: <input type="number" name="price"></label>
			<div class="error" id="spu-error-price"></div>
			<label>Type:
				<select name="type">
					<option value="">Select type</option>
					<option value="monthly">Monthly</option>
					<option value="2_month">2 Month</option>
					<option value="3_month">3 Month</option>
					<option value="yearly">Yearly</option>
				</select>
			</label>
			<div class="error" id="spu-error-type"></div>
			<button type="submit">Update</button>
			<div class="error" id="subscription-plan-update-error"></div>
			<div class="response" id="subscription-plan-update-response"></div>
		</form>
		<form id="subscription-plan-delete-form">
			<h3>Delete Subscription Plan</h3>
			<label>Plan ID: <input type="number" name="id" required></label>
			<div class="error" id="spd-error-id"></div>
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
			<div class="error" id="vpc-error-price"></div>
			<label>Number of Voyages: <input type="number" name="number_of_voyages" required></label>
			<div class="error" id="vpc-error-number_of_voyages"></div>
			<label>Expiration:
				<select name="expiration" required>
					<option value="">Select expiration</option>
					<option value="6_month">6 Month</option>
					<option value="1_year">1 Year</option>
				</select>
			</label>
			<div class="error" id="vpc-error-expiration"></div>
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
		<form id="voyage-plan-update-form">
			<h3>Update Voyage Plan</h3>
			<label>Plan ID: <input type="number" name="id" required></label>
			<div class="error" id="vpu-error-id"></div>
			<label>Price: <input type="number" name="price"></label>
			<div class="error" id="vpu-error-price"></div>
			<label>Number of Voyages: <input type="number" name="number_of_voyages"></label>
			<div class="error" id="vpu-error-number_of_voyages"></div>
			<label>Expiration:
				<select name="expiration">
					<option value="">Select expiration</option>
					<option value="6_month">6 Month</option>
					<option value="1_year">1 Year</option>
				</select>
			</label>
			<div class="error" id="vpu-error-expiration"></div>
			<button type="submit">Update</button>
			<div class="error" id="voyage-plan-update-error"></div>
			<div class="response" id="voyage-plan-update-response"></div>
		</form>
		<form id="voyage-plan-delete-form">
			<h3>Delete Voyage Plan</h3>
			<label>Plan ID: <input type="number" name="id" required></label>
			<div class="error" id="vpd-error-id"></div>
			<button type="submit">Delete</button>
			<div class="error" id="voyage-plan-delete-error"></div>
			<div class="response" id="voyage-plan-delete-response"></div>
		</form>
	</div>

	<script>
		// Helper to clear field errors
		function clearFieldErrors(prefix) {
			document.querySelectorAll(`[id^='${prefix}-error-']`).forEach(e => e.innerText = '');
		}
		// Helper to show field errors
		function showFieldErrors(prefix, errors) {
			for (const key in errors) {
				const el = document.getElementById(`${prefix}-error-${key}`);
				if (el) el.innerText = errors[key][0];
			}
		}

		// Subscription Plan Create
		document.getElementById('subscription-plan-create-form').onsubmit = async function(e) {
			e.preventDefault();
			clearFieldErrors('spc');
			document.getElementById('subscription-plan-create-error').innerText = '';
			const f = e.target;
			const data = {
				name: f.name.value,
				price: f.price.value,
				type: f.type.value
			};
			try {
				const res = await fetch('/api/subscription-plans', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + (localStorage.getItem('api_token')||'') },
					body: JSON.stringify(data)
				});
				const json = await res.json();
				if (res.ok) {
					document.getElementById('subscription-plan-create-response').innerText = JSON.stringify(json, null, 2);
				} else if (json.errors) {
					showFieldErrors('spc', json.errors);
				} else {
					document.getElementById('subscription-plan-create-error').innerText = JSON.stringify(json, null, 2);
				}
			} catch (err) {
				document.getElementById('subscription-plan-create-error').innerText = err;
			}
		};
		// Subscription Plan List
		document.getElementById('subscription-plan-list-form').onsubmit = async function(e) {
			e.preventDefault();
			document.getElementById('subscription-plan-list-error').innerText = '';
			try {
				const res = await fetch('/api/subscription-plans', {
					headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + (localStorage.getItem('api_token')||'') }
				});
				const json = await res.json();
				if (res.ok) {
					document.getElementById('subscription-plan-list-response').innerText = JSON.stringify(json, null, 2);
				} else {
					document.getElementById('subscription-plan-list-error').innerText = JSON.stringify(json, null, 2);
				}
			} catch (err) {
				document.getElementById('subscription-plan-list-error').innerText = err;
			}
		};
		// Subscription Plan Update
		document.getElementById('subscription-plan-update-form').onsubmit = async function(e) {
			e.preventDefault();
			clearFieldErrors('spu');
			document.getElementById('subscription-plan-update-error').innerText = '';
			const f = e.target;
			const id = f.id.value;
			const data = {};
			['name','price','type'].forEach(k => { if(f[k].value) data[k]=f[k].value; });
			try {
				const res = await fetch(`/api/subscription-plans/${id}`, {
					method: 'PUT',
					headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + (localStorage.getItem('api_token')||'') },
					body: JSON.stringify(data)
				});
				const json = await res.json();
				if (res.ok) {
					document.getElementById('subscription-plan-update-response').innerText = JSON.stringify(json, null, 2);
				} else if (json.errors) {
					showFieldErrors('spu', json.errors);
				} else {
					document.getElementById('subscription-plan-update-error').innerText = JSON.stringify(json, null, 2);
				}
			} catch (err) {
				document.getElementById('subscription-plan-update-error').innerText = err;
			}
		};
		// Subscription Plan Delete
		document.getElementById('subscription-plan-delete-form').onsubmit = async function(e) {
			e.preventDefault();
			clearFieldErrors('spd');
			document.getElementById('subscription-plan-delete-error').innerText = '';
			const id = e.target.id.value;
			try {
				const res = await fetch(`/api/subscription-plans/${id}`, {
					method: 'DELETE',
					headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + (localStorage.getItem('api_token')||'') }
				});
				const text = await res.text();
				let json;
				try { json = JSON.parse(text); } catch { json = text; }
				if (res.ok) {
					document.getElementById('subscription-plan-delete-response').innerText = JSON.stringify(json, null, 2);
				} else {
					document.getElementById('subscription-plan-delete-error').innerText = JSON.stringify(json, null, 2);
				}
			} catch (err) {
				document.getElementById('subscription-plan-delete-error').innerText = err;
			}
		};

		// Voyage Plan Create
		document.getElementById('voyage-plan-create-form').onsubmit = async function(e) {
			e.preventDefault();
			clearFieldErrors('vpc');
			document.getElementById('voyage-plan-create-error').innerText = '';
			const f = e.target;
			const data = {
				price: f.price.value,
				number_of_voyages: f.number_of_voyages.value,
				expiration: f.expiration.value
			};
			try {
				const res = await fetch('/api/voyage-plans', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + (localStorage.getItem('api_token')||'') },
					body: JSON.stringify(data)
				});
				const json = await res.json();
				if (res.ok) {
					document.getElementById('voyage-plan-create-response').innerText = JSON.stringify(json, null, 2);
				} else if (json.errors) {
					showFieldErrors('vpc', json.errors);
				} else {
					document.getElementById('voyage-plan-create-error').innerText = JSON.stringify(json, null, 2);
				}
			} catch (err) {
				document.getElementById('voyage-plan-create-error').innerText = err;
			}
		};
		// Voyage Plan List
		document.getElementById('voyage-plan-list-form').onsubmit = async function(e) {
			e.preventDefault();
			document.getElementById('voyage-plan-list-error').innerText = '';
			try {
				const res = await fetch('/api/voyage-plans', {
					headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + (localStorage.getItem('api_token')||'') }
				});
				const json = await res.json();
				if (res.ok) {
					document.getElementById('voyage-plan-list-response').innerText = JSON.stringify(json, null, 2);
				} else {
					document.getElementById('voyage-plan-list-error').innerText = JSON.stringify(json, null, 2);
				}
			} catch (err) {
				document.getElementById('voyage-plan-list-error').innerText = err;
			}
		};
		// Voyage Plan Update
		document.getElementById('voyage-plan-update-form').onsubmit = async function(e) {
			e.preventDefault();
			clearFieldErrors('vpu');
			document.getElementById('voyage-plan-update-error').innerText = '';
			const f = e.target;
			const id = f.id.value;
			const data = {};
			['price','number_of_voyages','expiration'].forEach(k => { if(f[k].value) data[k]=f[k].value; });
			try {
				const res = await fetch(`/api/voyage-plans/${id}`, {
					method: 'PUT',
					headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': 'Bearer ' + (localStorage.getItem('api_token')||'') },
					body: JSON.stringify(data)
				});
				const json = await res.json();
				if (res.ok) {
					document.getElementById('voyage-plan-update-response').innerText = JSON.stringify(json, null, 2);
				} else if (json.errors) {
					showFieldErrors('vpu', json.errors);
				} else {
					document.getElementById('voyage-plan-update-error').innerText = JSON.stringify(json, null, 2);
				}
			} catch (err) {
				document.getElementById('voyage-plan-update-error').innerText = err;
			}
		};
		// Voyage Plan Delete
		document.getElementById('voyage-plan-delete-form').onsubmit = async function(e) {
			e.preventDefault();
			clearFieldErrors('vpd');
			document.getElementById('voyage-plan-delete-error').innerText = '';
			const id = e.target.id.value;
			try {
				const res = await fetch(`/api/voyage-plans/${id}`, {
					method: 'DELETE',
					headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + (localStorage.getItem('api_token')||'') }
				});
				const text = await res.text();
				let json;
				try { json = JSON.parse(text); } catch { json = text; }
				if (res.ok) {
					document.getElementById('voyage-plan-delete-response').innerText = JSON.stringify(json, null, 2);
				} else {
					document.getElementById('voyage-plan-delete-error').innerText = JSON.stringify(json, null, 2);
				}
			} catch (err) {
				document.getElementById('voyage-plan-delete-error').innerText = err;
			}
		};
	</script>
</body>
</html>
