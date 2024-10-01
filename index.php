<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Money via M-Pesa</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Real-time M-Pesa Transactions</h1>
    </header>

    <section id="send-money">
        <h2>Send Money</h2>
        <form id="mpesa-form" method="post" action="send_money.php">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required><br>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required><br>

            <input type="submit" value="Send Money">
        </form>
        <p id="response"></p>
    </section>

    <section id="transactions">
        <h2>Transaction History</h2>
        <div id="transaction-list"></div>
    </section>

    <script src="assets/js/main.js"></script>
</body>
</html>