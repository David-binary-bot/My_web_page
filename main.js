document.getElementById('mpesa-form').addEventListener('submit', function(e) {
    e.preventDefault();

    let phone = document.getElementById('phone').value;
    let amount = document.getElementById('amount').value;

    let formData = new FormData();
    formData.append('phone', phone);
    formData.append('amount', amount);

    fetch('send_money.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('response').innerHTML = 'Transaction successful!';
        updateTransactions(); // Update transaction list
    })
    .catch(error => console.error('Error:', error));
});

function updateTransactions() {
    fetch('transactions.php')
    .then(response => response.text())
    .then(data => {
        document.getElementById('transaction-list').innerHTML = data;
    });
}

// Automatically update transaction list every 10 seconds
setInterval(updateTransactions, 10000);