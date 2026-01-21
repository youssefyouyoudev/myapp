{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div class="container py-5">
    <h2>Test Link Card to Client</h2>
    <form id="link-card-form">
        <div class="mb-3">
            <label for="card_id" class="form-label">Card ID</label>
            <input type="number" class="form-control" id="card_id" name="card_id" required>
        </div>
        <div class="mb-3">
            <label for="nfc_uid" class="form-label">NFC UID</label>
            <input type="text" class="form-control" id="nfc_uid" name="nfc_uid" required>
        </div>
        <div class="mb-3">
            <label for="client_id" class="form-label">Client ID</label>
            <input type="number" class="form-control" id="client_id" name="client_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Link Card</button>
    </form>
    <div class="mt-3">
        <pre id="link-card-response"></pre>
    </div>
</div>
<script>
    document.getElementById('link-card-form').onsubmit = async function(e) {
        e.preventDefault();
        const card_id = document.getElementById('card_id').value;
        const nfc_uid = document.getElementById('nfc_uid').value;
        const client_id = document.getElementById('client_id').value;
        const token = localStorage.getItem('api_token') || '';
        const res = await fetch(`/api/cards/${card_id}/link`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify({
                client_id: client_id,
                nfc_uid: nfc_uid
            })
        });
        const json = await res.json();
        document.getElementById('link-card-response').innerText = JSON.stringify(json, null, 2);
    };
</script>
{{-- @endsection --}}
