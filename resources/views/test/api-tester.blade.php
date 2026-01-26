<div class="container">
	<h2>Etudiant API Tester</h2>
	<div>
		<h4>List Etudiants</h4>
		<button onclick="listEtudiants()">GET /api/etudiants</button>
	</div>
	<div>
		<h4>Show Etudiant</h4>
		<input type="number" id="showEtudiantId" placeholder="Etudiant ID">
		<button onclick="showEtudiant()">GET /api/etudiants/{id}</button>
	</div>
	<div>
		<h4>Response</h4>
		<div id="etudiantImages"></div>
		<div id="etudiantError" style="color:red;"></div>
		<pre id="etudiantResponse"></pre>
	</div>
</div>
<script>
function setEtudiantResponse(data) {
	document.getElementById('etudiantError').textContent = '';
	const imgFields = [
		'img_user',
		'img_carte_nationale',
		'img_carte_nationale_verso',
		'img_carte_etudiant'
	];
	let imagesHtml = '';
	function renderImages(obj) {
		let html = '';
		imgFields.forEach(field => {
			if (obj && obj[field]) {
				let url = obj[field].startsWith('http') ? obj[field] : ('/storage/' + obj[field]);
				html += `<div><b>${field}:</b><br><img src="${url}" alt="${field}" style="max-width:200px;max-height:200px;"></div>`;
			}
		});
		return html;
	}
	if (data && data.data && Array.isArray(data.data)) {
		imagesHtml = data.data.map(e => renderImages(e)).join('');
	} else if (data && typeof data === 'object') {
		imagesHtml = renderImages(data);
	} else {
		imagesHtml = '';
	}
	document.getElementById('etudiantImages').innerHTML = imagesHtml;
	document.getElementById('etudiantResponse').textContent = typeof data === 'string' ? data : JSON.stringify(data, null, 2);
}
function showEtudiant() {
	const id = document.getElementById('showEtudiantId').value;
	fetch(`/api/etudiants/${id}`)
		.then(async r => {
			const text = await r.text();
			try { setEtudiantResponse(JSON.parse(text)); }
			catch { setEtudiantResponse(text); }
		})
		.catch(e => setEtudiantResponse(e.toString()));
}
function listEtudiants() {
	fetch('/api/etudiants')
		.then(async r => {
			const text = await r.text();
			try { setEtudiantResponse(JSON.parse(text)); }
			catch { setEtudiantResponse(text); }
		})
		.catch(e => setEtudiantResponse(e.toString()));
}
</script>

