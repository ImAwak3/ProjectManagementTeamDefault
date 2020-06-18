CREATE TABLE users(
    user_ID int PRIMARY KEY,
    first_Name VARCHAR(50) NOT NULL,
    last_Name VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Address VARCHAR(50),
    phone_Number VARCHAR(15),
    Username VARCHAR(50),
    Password VARCHAR(50),
    user_Type VARCHAR(100),
    verification_Code VARCHAR(200),
    createdDate TIMESTAMP,
    is_Verified varchar(1) DEFAULT 'N'
);

CREATE TABLE trader_type(
    tradertype_id int PRIMARY KEY,
    trader_id int REFERENCES trader(trader_id) not null
);

CREATE TABLE customer(
    customer_ID int PRIMARY KEY,
    user_ID int REFERENCES users(user_ID) not null
);

CREATE TABLE admin(
    admin_ID int PRIMARY KEY,
    user_ID int REFERENCES users(user_ID) not null
);


CREATE TABLE activity_report(
    activityReport_ID int PRIMARY KEY,
    user_ID int REFERENCES users(user_ID),
    admin_ID int REFERENCES admin(admin_ID),
    Activity VARCHAR(150)
);

CREATE TABLE trader(
    trader_ID int PRIMARY KEY,
    user_ID int REFERENCES users(user_ID) not null,
    traderType VARCHAR(100) NOT NULL,
    shop_Name VARCHAR(200) NOT NULL
);

CREATE TABLE shop(
    shop_ID int PRIMARY KEY,
    traderType_ID int REFERENCES trader_type(traderType_ID) not null
); 

CREATE TABLE product_type(
    productType_ID int PRIMARY KEY,
    shop_ID int REFERENCES shop(shop_ID)
);



CREATE TABLE product(
    product_ID int PRIMARY KEY,
    productType_ID int REFERENCES product_type(productType_ID) NOT NULL,
    product_Name VARCHAR(50) NOT NULL,
    Description VARCHAR(200),
    product_Price NUMERIC(6,1) NOT NULL,
    quantity_perItem VARCHAR(20) NOT NULL,
    stock_Available VARCHAR(1) NOT NULL,
    min_Order int NOT NULL,
    max_Order int NOT NULL,
    allergy_Information VARCHAR(150),
    productImage_Code VARCHAR(50)
);  


CREATE TABLE product_review(
    productReview_ID int PRIMARY KEY,
    product_ID int REFERENCES product(product_ID),
    user_ID int REFERENCES users(user_ID),
    replied_Of REFERENCES product_review(productReview_ID),
    Comments VARCHAR(150)
);
    
CREATE TABLE cart(
    cart_ID int PRIMARY KEY,
    customer_ID int REFERENCES customer(customer_ID)
);
  

CREATE TABLE product_cart(
    productCart_ID int PRIMARY KEY,
    cart_ID int REFERENCES cart(cart_ID) not null,
    product_ID int REFERENCES product(product_ID) not null,
    added_Date date not null,
    product_Price int not null
);

CREATE TABLE discount(
    discount_ID int PRIMARY KEY,
    discount_Amount int
);


CREATE TABLE invoice(
    invoice_ID int PRIMARY KEY,
    discount_ID int REFERENCES discount(discount_ID),
    invoice_Date date not null,
    total_Amount int not null,
    delivery_Status varchar(1)
);

CREATE TABLE collection_slot(
    collectionSlot_ID int PRIMARY KEY,
    added_By int REFERENCES users(user_ID)not null ,
    dayOf_Week varchar(10) not null,
    start_Time TIMESTAMP,
    end_Time TIMESTAMP
);


CREATE TABLE payment_detail(
    paymentDetail_ID int PRIMARY KEY,
    productCart_ID int REFERENCES cart(cart_ID) not null,
    collectionSlot_ID int REFERENCES collection_slot(collectionSlot_ID) not null,
    invoice_ID int REFERENCES invoice(invoice_ID) not null,
    payment_Method varchar(10) not null
);
