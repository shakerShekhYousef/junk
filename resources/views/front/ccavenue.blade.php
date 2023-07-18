<html>
<head>
    <title> Non-Seamless-kit</title>
</head>
<body>
<center>

    <form method="post" name="redirect" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction">
        @csrf
        <input type=hidden name=encRequest value={{$encrypted_data}}>
        <input type=hidden name=access_code value={{$access_code}}>

    </form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

