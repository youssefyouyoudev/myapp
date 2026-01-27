<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>API Tester - Logs by User</title>
	<style>
		body { font-family: Arial, sans-serif; margin: 2em; }
		label { display: block; margin-top: 1em; }
		input, button { padding: 0.5em; margin-top: 0.5em; }
		pre { background: #f4f4f4; padding: 1em; border-radius: 5px; }
	</style>
</head>
<body>
	<h2>Test Logs by User API</h2>
	<form id="logForm">
		<label>User ID:
			<input type="number" name="user_id" id="user_id" required>
		</label>
		<label>Start Date:
			<input type="date" name="start_date" id="start_date" required>
		</label>
		<label>End Date:
			<input type="date" name="end_date" id="end_date" required>
		</label>
		<button type="submit">Test API</button>
	</form>
	<h3>Response:</h3>
	<pre id="response"></pre>

	<script>
		document.getElementById('logForm').addEventListener('submit', async function(e) {
			e.preventDefault();
			const userId = document.getElementById('user_id').value;
			const startDate = document.getElementById('start_date').value;
			const endDate = document.getElementById('end_date').value;
			const url = `/api/logs/user/${userId}?start_date=${startDate}&end_date=${endDate}`;
			document.getElementById('response').textContent = 'Loading...';
			try {
				const res = await fetch(url);
				const data = await res.json();
				document.getElementById('response').textContent = JSON.stringify(data, null, 2);
			} catch (err) {
				document.getElementById('response').textContent = 'Error: ' + err;
			}
		});
	</script>
</body>
</html>
