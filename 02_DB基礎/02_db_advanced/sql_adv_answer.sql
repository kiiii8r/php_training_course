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

-- 問５
-- SELECT p.kickoff, (
--   SELECT cm.name
--   FROM countries AS cm
--   WHERE p.my_country_id = cm.id) AS '国名１',
--   (
--   SELECT ce.name
--   FROM countries AS ce
--   WHERE p.enemy_country_id = ce.id) AS '国名２'
-- FROM pairings AS p
-- ORDER BY p.kickoff ASC;

-- 問６
-- SELECT p.name 名前, p.position ポジション, p.club 所属クラブ, (SELECT COUNT(g.id) FROM goals g WHERE g.player_id = p.id) ゴール数
-- FROM players p
-- ORDER BY ゴール数 DESC;

-- 問７
-- SELECT p.name 名前, p.position ポジション, p.club 所属クラブ,
-- COUNT(g.player_id) ゴール数
-- FROM players p
-- JOIN goals g
-- ON p.id = g.player_id
-- GROUP BY g.player_id
-- ORDER BY ゴール数 DESC;

-- 問８
-- SELECT p.position ポジション, COUNT(g.player_id) ゴール数
-- FROM players p
-- LEFT JOIN goals g
-- ON g.player_id = p.id
-- GROUP BY p.position
-- ORDER BY ゴール数 DESC;

-- 問９
-- SELECT DATE_FORMAT(birth, '%Y-%m-%d') birth,  TIMESTAMPDIFF(YEAR, birth, '20140613') age, name, position
-- FROM players
-- ORDER BY age DESC;