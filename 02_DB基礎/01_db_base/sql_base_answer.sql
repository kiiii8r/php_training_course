USE cafe;

-- 問１
-- SELECT uniform_num, name, club
-- FROM players;

-- 問２
-- SELECT name, ranking, group_name
-- FROM countries
-- WHERE group_name='C';

-- 問３
-- SELECT name, ranking, group_name
-- FROM countries
-- WHERE group_name != 'C' ;

-- 問４
-- SELECT *
-- FROM players
-- WHERE TIMESTAMPDIFF(YEAR, `birth`, CURDATE()) >= 40;

-- 問５
-- SELECT *
-- FROM players
-- WHERE height < 170;

-- 問６
-- SELECT *
-- FROM countries
-- WHERE ranking BETWEEN 36 AND 56;

-- 問７
-- SELECT *
-- FROM players
-- WHERE position IN('GK', 'DF', 'MF');

-- 問８
-- SELECT *
-- FROM goals
-- WHERE player_id IS NULL;

-- 問９
-- SELECT *
-- FROM goals
-- WHERE player_id IS NOT NULL;

-- 問１０
-- SELECT *
-- FROM players
-- WHERE name LIKE '%ニョ';

-- 問１１
-- SELECT *
-- FROM players
-- WHERE name LIKE '%ニョ%';

-- 問１２
-- SELECT *
-- FROM countries
-- WHERE group_name NOT IN('A'); 

-- 問１３
-- SELECT *
-- FROM players
-- WHERE FLOOR(weight / POW(height / 100, 2)) = 20;

-- 問１４
-- SELECT *
-- FROM players
-- WHERE height < 165 OR weight < 60;

-- 問１５
-- SELECT *
-- FROM players
-- WHERE position IN('FW', 'MF') AND height < 170;

-- 問１６
-- SELECT DISTINCT position
-- FROM players

-- 問１７
-- SELECT name, club, height + weight AS 'height + weight'
-- FROM players

-- 問１８
-- SELECT CONCAT(name, "選手のポジションは'", position, "'です") AS POSITION
-- FROM players;

-- 問１９
-- SELECT name, club, height + weight AS '体力指数'
-- FROM players;

-- 問２０
-- SELECT *
-- FROM countries
-- ORDER BY ranking ASC;

-- 問２１
-- SELECT *
-- FROM players
-- ORDER BY birth DESC;

-- 問２２
-- SELECT *
-- FROM players
-- ORDER BY height DESC;

-- 問２３
-- SELECT id, uniform_num, SUBSTRING(position, 1, 1), name
-- FROM players 

-- 問２４
-- SELECT name, LENGTH(name) 
-- FROM countries
-- ORDER BY LENGTH(name) DESC;

-- 問２５
-- SELECT name , DATE_FORMAT(birth,'%Y年%m月%d日') AS birthday
-- FROM players
