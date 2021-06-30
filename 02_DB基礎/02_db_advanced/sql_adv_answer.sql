USE cafe;

-- 問１
-- SELECT group_name AS 'グループ', MIN(ranking) AS 'ランキング最上位', MAX(ranking) AS 'ランキング最下位'
-- FROM countries
-- GROUP BY group_name;

-- 問２
-- SELECT AVG(height) AS '平均身長', AVG(weight) AS '平均体重'
-- FROM players
-- WHERE position = 'GK';

-- 問３
-- SELECT c.name AS '国名', AVG(p.height) AS '平均身長'
-- FROM countries AS c
-- JOIN players AS p
-- ON c.id = p.country_id
-- GROUP BY c.name
-- ORDER BY AVG(p.height) DESC;

-- 問４
-- SELECT (
--   SELECT c.name
--   FROM countries AS c 
--   WHERE c.id = p.country_id) AS '国名', 
--   AVG(p.height) AS '平均身長'
-- FROM players AS p
-- GROUP BY p.country_id
-- ORDER BY AVG(p.height) DESC;