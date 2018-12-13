DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ProductHaving`(IN `Station` VARCHAR(10) CHARSET utf8)
BEGIN
SELECT
    A.Product_name,
    (
        A.Product_amount - IFNULL(B.Transaction_amount, 0)
    ) AS Total_Amount,
    A.Product_Cost,
    A.Product_Price,
    A.Station_Name,
    A.Supplier_name
FROM
    (
    SELECT
        Product.Product_name,
        SUM(Product.Product_amount) AS Product_amount,
        ROUND(AVG(Product.Cost),
        2) AS Product_Cost,
        MAX(Product.Price) AS Product_Price,
        Product.Station_ID,
        Station.Name AS Station_Name,
        Supplier.Supplier_name
    FROM
        Product,
        Station,
        Supplier
    WHERE
        Product.Station_ID = Station.Station_ID AND Station.Product_Supplier_ID = Supplier.Supplier_ID
    GROUP BY
        Product.Product_name,
        Station.Product_Supplier_ID,
        Product.Station_ID
) AS A
LEFT JOIN(
    SELECT
        Product.Product_name,
        Required.Transaction_amount,
        Product.Station_ID,
        Station.Name AS Station_Name
    FROM
        Required,
        Product,
        Station
    WHERE
        Product.Product_ID = Required.Product_ID AND Station.Station_ID = Product.Station_ID
) AS B
ON
    A.Product_name = B.Product_name
WHERE 
	A.Station_Name = Station;
END$$
DELIMITER ;