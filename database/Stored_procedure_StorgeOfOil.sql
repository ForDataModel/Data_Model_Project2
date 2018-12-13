DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `StorgeOfOil`(IN `Station` VARCHAR(10) CHARSET utf8)
BEGIN
SELECT
    B.Name,
    (
        B.Oil_amount + IFNULL(A.Oil_Acoumt, 0)
    ) AS Total_Amount,
    B.Oil_Cost,
    B.Oil_Price,
    B.Station_ID,
    B.Station_Name,
    B.Supplier_name
FROM
    (
    SELECT
        Oil.Name,
        SUM(Oil.Oil_amount) AS Oil_amount,
        ROUND(AVG(Oil.Oil_cost),
        2) AS Oil_Cost,
        MAX(Oil.Oil_price) AS Oil_Price,
        Oil.Station_ID,
        Station.Name AS Station_Name,
        Supplier.Supplier_name
    FROM
        Oil,
        Station,
        Supplier
    WHERE
        Oil.Station_ID = Station.Station_ID AND Station.Oil_Supplier_ID = Supplier.Supplier_ID
    GROUP BY
        Oil.Name,
        Station.Oil_Supplier_ID,
        Oil.Station_ID
) AS B
LEFT JOIN(
    SELECT Oil.Name AS Oil_Name,
        (0 - SUM(Buy.Buy_amount)) AS Oil_Acoumt,
        ROUND(AVG(Oil.Oil_cost),
        2) AS Oil_Cost,
        MAX(Oil.Oil_price) AS Oil_Price,
        Oil.Station_ID,
        Station.Name AS Station_Name,
        Supplier.Supplier_name
    FROM
        Buy,
        Oil,
        Station,
        Supplier
    WHERE
        Oil.Oil_ID = Buy.Oil_ID AND Station.Station_ID = Oil.Station_ID AND Station.Oil_Supplier_ID = Supplier.Supplier_ID
    GROUP BY
        Oil.Name,
        Station.Oil_Supplier_ID,
        Oil.Station_ID
) AS A
ON
    A.Oil_Name = B.Name
WHERE 
	B.Station_Name = Station;
END$$
DELIMITER ;