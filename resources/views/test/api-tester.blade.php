<h2>Charge Subscription</h2>
<form id="charge-subscription-form">
	<label>Etudiant ID: <input type="text" name="etudiant_id" required></label><br>
	<label>Card UUID: <input type="text" name="card_uuid" required></label><br>
	<label>Subscription Plan ID: <input type="text" name="subscription_plan_id" required></label><br>
	<label>Amount: <input type="number" step="0.01" name="amount" required></label><br>
	<label>Note: <input type="text" name="note"></label><br>
	<label>Token: <input type="text" name="token" required></label><br>
	<button type="submit">Charge Subscription</button>
</form>
<pre id="charge-subscription-result"></pre>

<h2>Charge Voyage</h2>
<form id="charge-voyage-form">
	<label>Etudiant ID: <input type="text" name="etudiant_id" required></label><br>
	<label>Card UUID: <input type="text" name="card_uuid" required></label><br>
	<label>Voyage Plan ID: <input type="text" name="voyage_plan_id" required></label><br>
	<label>Amount: <input type="number" step="0.01" name="amount" required></label><br>
	<label>Number of Voyages: <input type="number" name="number_of_voyages" min="1" value="1" required></label><br>
	<label>Note: <input type="text" name="note"></label><br>
	<label>Token: <input type="text" name="token" required></label><br>
	<button type="submit">Charge Voyage</button>
</form>
<pre id="charge-voyage-result"></pre>

<script>
// Helper to POST JSON with Bearer token
async function postWithToken(url, data, token) {
	const res = await fetch(url, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + token
		},
		body: JSON.stringify(data)
	});
	return res.json();
}

// Charge Subscription
document.getElementById('charge-subscription-form').onsubmit = async function(e) {
	e.preventDefault();
	const form = e.target;
	const etudiant_id = form.etudiant_id.value;
	const url = `/api/etudiants/${etudiant_id}/charge-subscription`;
	const data = {
		card_uuid: form.card_uuid.value,
		subscription_plan_id: form.subscription_plan_id.value,
		amount: form.amount.value,
		note: form.note.value
	};
	const token = form.token.value;
	document.getElementById('charge-subscription-result').textContent = 'Loading...';
	try {
		const result = await postWithToken(url, data, token);
		document.getElementById('charge-subscription-result').textContent = JSON.stringify(result, null, 2);
	} catch (err) {
		document.getElementById('charge-subscription-result').textContent = 'Error: ' + err;
	}
};

// Charge Voyage
document.getElementById('charge-voyage-form').onsubmit = async function(e) {
	e.preventDefault();
	const form = e.target;
	const etudiant_id = form.etudiant_id.value;
	const url = `/api/etudiants/${etudiant_id}/charge-voyage`;
	const data = {
		card_uuid: form.card_uuid.value,
		voyage_plan_id: form.voyage_plan_id.value,
		amount: form.amount.value,
		number_of_voyages: form.number_of_voyages.value,
		note: form.note.value
	};
	const token = form.token.value;
	document.getElementById('charge-voyage-result').textContent = 'Loading...';
	try {
		const result = await postWithToken(url, data, token);
		document.getElementById('charge-voyage-result').textContent = JSON.stringify(result, null, 2);
	} catch (err) {
		document.getElementById('charge-voyage-result').textContent = 'Error: ' + err;
	}
};
</script>
