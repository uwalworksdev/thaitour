<form action="/payment/request" method="post">
    <label>상품명:</label>
    <input type="text" name="orderName" value="Sample Product" readonly><br>
    <label>금액:</label>
    <input type="number" name="amount" value="10000" readonly><br>
    <button type="submit">결제하기</button>
</form>