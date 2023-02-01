<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .body{
            
            align-content: center;
            text-align: center;
            align-items: center;
        }
    </style>
</head>
<body class="body">
   <table>
    <th>
        <tr>
            <th> <h1>Order_Details</h1></th>
        </tr>
    </th>
    <tbody>
        <tr>
            <td>
                <h3> Name : {{ $data->name }}</h3></td>
        </tr>
        <tr>
            <td> <h3> Email : {{ $data->email }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Phone : {{ $data->phone }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Address : {{ $data->address }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> User_id : {{ $data->user_id }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Tittle : {{ $data->tittle }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Description : {{ $data->description }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Price : {{ $data->price }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Quantity : {{ $data->quantity }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Image : {{ $data->image }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Payment_status : {{ $data->payment_status }}</h3></td></td>
        </tr>
        <tr>
            <td> <h3> Delivery_status : {{ $data->delivery_status }}</h3></td></td>
        </tr>
    </tbody>
   </table>
</body>
</html>