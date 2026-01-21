<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>API Test: Charge Subscription & Voyage</title> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        async function submitForm(e, formId, resultId) {
            e.preventDefault();
            const form = document.getElementById(formId);
            const data = Object.fromEntries(new FormData(form));
            const clientId = data.client_id;
            delete data.client_id;
            let url = '';
            if (formId === 'subscriptionForm') {
                url = `/api/clients/${clientId}/charge-subscription`;
            } else {
                url = `/api/clients/${clientId}/charge-voyage`;
            }
            document.getElementById(resultId).innerHTML = '<div class="text-info">Sending request...</div>';
            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });
                const json = await res.json();
                document.getElementById(resultId).innerHTML = `<pre class='bg-light p-2'>${JSON.stringify(json, null, 2)}</pre>`;
            } catch (err) {
                document.getElementById(resultId).innerHTML = `<div class='text-danger'>Error: ${err}</div>`;
            }
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4"> Charge Subscription</h2>
    <form id="subscriptionForm" class="card card-body mb-4" onsubmit="submitForm(event, 'subscriptionForm', 'subscriptionResult')">
        <div class="mb-2">
            <label>Client ID</label>
            <input type="number" name="client_id" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Subscription Plan ID</label>
            <input type="number" name="subscription_plan_id" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Card UUID</label>
            <input type="text" name="card_uuid" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Note</label>
            <input type="text" name="note" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Charge Subscription</button>
    </form>
    <div id="subscriptionResult"></div>

    <hr class="my-5">

    <h2 class="mb-4"> Charge Voyage</h2>
    <form id="voyageForm" class="card card-body mb-4" onsubmit="submitForm(event, 'voyageForm', 'voyageResult')">
        <div class="mb-2">
            <label>Client ID</label>
            <input type="number" name="client_id" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Voyage Plan ID</label>
            <input type="number" name="voyage_plan_id" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Card UUID</label>
            <input type="text" name="card_uuid" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Note</label>
            <input type="text" name="note" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Charge Voyage</button>
    </form>
    <div id="voyageResult"></div>
</div>
</body>
</html>
