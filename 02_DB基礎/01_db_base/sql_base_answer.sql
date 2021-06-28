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
-- FROM players;

-- 問２６
-- SELECT IFNULL(player_id, 9999) AS player_id, goal_time
-- FROM goals;

-- 問２７
-- SELECT 
--   CASE WHEN player_id IS NULL THEN 9999 
--   ELSE player_id END 
--   AS player_id, 
--   goal_time
-- FROM goals;

-- 問２８
-- SELECT AVG(height) AS '平均身長', AVG(weight) AS '平均体重'
-- FROM players;

-- 問２９
-- SELECT COUNT(id) AS '日本のゴール数'
-- FROM goals
-- WHERE player_id BETWEEN 714 AND 736;

-- 問３０
-- SELECT COUNT(player_id) AS 'オウンゴール以外のゴール数'
-- FROM goals;

-- 問３１
-- SELECT MAX(height) AS '最大身長', MAX(weight) AS '最大体重'
-- FROM players;

-- 問３２
-- SELECT MIN(ranking) AS 'AグループのFIFAランク最上位'
-- FROM countries
-- WHERE group_name IN('A');

-- 問３３
-- SELECT SUM(ranking) AS 'CグループのFIFAランクの合計値'
-- FROM countries
-- WHERE group_name IN('C');

-- 問３４
-- SELECT c.name AS name_c, p.name AS name_p, p.uniform_num
-- FROM players AS p 
-- JOIN countries AS c
-- ON p.country_id = c.id

-- 問３５
-- SELECT c.name AS name_c, p.name AS name_p, g.goal_time
-- FROM players AS p 
-- JOIN countries AS c
-- ON p.country_id = c.id
-- JOIN goals AS g
-- ON p.id = g.player_id;

-- 問３６
-- SELECT g.goal_time, p.uniform_num, p.position, p.name 
-- FROM goals AS g
-- LEFT JOIN players AS p
-- ON g.player_id = p.id;

-- 問３７
-- SELECT g.goal_time, p.uniform_num, p.position, p.name 
-- FROM players AS p
-- RIGHT JOIN goals AS g
-- ON g.player_id = p.id;

-- 問３８
-- SELECT c.name AS country_name, g.goal_time, p.position, p.name AS player_name
-- FROM goals AS g
-- LEFT JOIN players AS p
-- ON g.player_id = p.id
-- LEFT JOIN countries  AS c
-- ON p.country_id = c.id;

-- 問３９
-- SELECT DATE_FORMAT(p.kickoff,'%Y-%m-%d %h:%i:%s') AS kickoff, mc.name AS my_country, ec.name AS enemy_country
-- FROM pairings AS p
-- JOIN countries AS mc
-- ON p.my_country_id = mc.id 
-- JOIN countries AS ec
-- ON p.enemy_country_id = ec.id;

-- 問４０
-- SELECT g.id, g.goal_time, (
--   SELECT p.name FROM players AS p WHERE g.player_id = p.id) AS player_name
-- FROM goals AS g
-- WHERE g.player_id IS NOT NULL;

-- 問４１
-- SELECT g.id, g.goal_time, p.name
-- FROM goals AS g
-- JOIN players AS p
-- ON p.id = g.player_id;

-- 問４２
-- SELECT mh.position, mh.max_height AS '最高身長', p.name, p.club
-- FROM players AS p,
--   (
--     SELECT position, MAX(height) AS max_height 
--     FROM players
--     GROUP BY position
--   ) AS mh
-- WHERE ( p.position = mh.position AND p.height = mh.max_height );

-- 問４３
-- SELECT p.position, MAX(p.height) AS '最大身長', (
--   SELECT pn.name
--   FROM players AS pn
--   WHERE pn.position = p.position AND pn.height = MAX(p.height) 
-- ) AS name
--   FROM players AS p
--   GROUP BY p.position;