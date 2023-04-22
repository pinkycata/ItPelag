##Задача 1 

SELECT Max(TIMESTAMPDIFF(YEAR, birthday, CURDATE())) as "max_year" 
from Student
INNER JOIN Student_in_class ON Student.id = Student_in_class.student 
INNER JOIN Class ON Class.id = Student_in_class.class
WHERE name LIKE "10%"

##Задача 2 

DELETE FROM Company
WHERE Company.id IN (
    SELECT company FROM Trip
    GROUP By company 
    HAVING COUNT(id ) = (
        SELECT Min(count) FROM (
            Select COUNT(id) as count from Trip 
            GROUP BY company
        )  as min_count
    )
            
)

##Задача 3
