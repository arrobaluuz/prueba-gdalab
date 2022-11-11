Definición de servicios

endpoint= /getToken
entrada= json {
    "email": "ana@gmail.com"
}

endpoint= customer/create
entrada= json{
    "token":"36912939754ec1a501cb9405a8641b3954570297",
    "dni":"456734567",
    "id_reg": "1",
    "id_com":"2", 
    "email": "customer4@gmail.com", 
    "name":"customer4",  
    "last_name":"last4",   
    "address":"addres 4 #45"
}

endpoint="customer/"
entrada=json{
    "token": "36912939754ec1a501cb9405a8641b3954570297",
    "searchBy": "788888838383"
}

endpoint="/customer/delete"
entrada=json{
    "token":"36912939754ec1a501cb9405a8641b3954570297",
    "searchBy": "customer3@gmail.com"
}