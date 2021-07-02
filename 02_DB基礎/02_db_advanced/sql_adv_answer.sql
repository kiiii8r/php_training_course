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

-- 問１０
-- SELECT COUNT(g.goal_time)
-- FROM goals g
-- WHERE g.player_id IS NULL;

-- 問１１
-- SELECT c.group_name, COUNT(g.id)
-- FROM pairings p
-- JOIN countries c
-- ON c.id = p.my_country_id
-- JOIN goals g
-- ON g.pairing_id = p.id
-- WHERE p.kickoff
-- BETWEEN '2014-06-13 00:00:00' AND '2014-6-27 23:59:59'
-- GROUP BY c.group_name;

-- 問１２
-- SELECT g.goal_time
-- FROM pairings p
-- JOIN goals g 
-- ON p.id = g.pairing_id
-- WHERE p.id = 103;

-- 問１３
-- SELECT c.name, COUNT(g.goal_time)
-- FROM countries c
-- JOIN pairings p
-- ON p.my_country_id = c.id
-- JOIN goals g
-- ON p.id = g.pairing_id
-- WHERE p.id = 39 OR p.id =103
-- GROUP BY c.name;

-- 問１４
-- SELECT DATE_FORMAT(p.kickoff, '%Y-%m-%d %h:%i:%s') kickoff, cm.name my_country, ce.name enemy_country, cm.ranking my_ranking, ce.ranking enemy_ranking, COUNT(g.id) my_goals
-- FROM pairings p
-- LEFT JOIN countries cm
-- ON cm.id = p.my_country_id
-- LEFT JOIN countries ce
-- ON ce.id = p.enemy_country_id
-- LEFT JOIN goals g
-- ON g.pairing_id = p.id
-- WHERE cm.group_name = 'C' AND ce.group_name = 'C'
-- GROUP BY p.kickoff, cm.name, ce.name, cm.ranking, ce.ranking 
-- ORDER BY p.kickoff, cm.ranking;

-- 問１５
-- SELECT DATE_FORMAT(p.kickoff, '%Y-%m-%d %h:%i:%s') kickoff, cm.name my_country, ce.name enemy_country, cm.ranking my_ranking, ce.ranking enemy_ranking, (
--   SELECT COUNT(g.id)
--   FROM goals g 
--   WHERE g.pairing_id = p.id
--   ) my_goals
-- FROM pairings p
-- LEFT JOIN countries cm
-- ON cm.id = p.my_country_id
-- LEFT JOIN countries ce
-- ON ce.id = p.enemy_country_id
-- WHERE cm.group_name = 'C' AND ce.group_name = 'C'
-- ORDER BY p.kickoff, my_goals DESC

-- 問１６
-- SELECT DATE_FORMAT(p.kickoff, '%Y-%m-%d %h:%i:%s') kickoff, cm.name my_country, ce.name enemy_country, cm.ranking my_ranking, ce.ranking enemy_ranking, (
--   SELECT COUNT(gm.id)
--   FROM goals gm 
--   WHERE gm.pairing_id = p.id
--   ) my_goals,
--   (
--   SELECT COUNT(ge.id)
--   FROM goals ge
--   LEFT JOIN pairings pe
--   ON ge.pairing_id = pe.id
--   WHERE pe.enemy_country_id = p.my_country_id AND pe.my_country_id = p.enemy_country_id
--   ) enemy_goals
-- FROM pairings p
-- LEFT JOIN countries cm
-- ON cm.id = p.my_country_id
-- LEFT JOIN countries ce
-- ON ce.id = p.enemy_country_id
-- WHERE cm.group_name = 'C' AND ce.group_name = 'C'
-- ORDER BY p.kickoff, my_goals DESC;

-- 問１７
-- SELECT DATE_FORMAT(p.kickoff, '%Y-%m-%d %h:%i:%s') kickoff, cm.name my_country, ce.name enemy_country, cm.ranking my_ranking, ce.ranking enemy_ranking, (
--   SELECT COUNT(gm.id)
--   FROM goals gm 
--   WHERE gm.pairing_id = p.id
--   ) my_goals,
--   (
--   SELECT COUNT(ge.id)
--   FROM goals ge
--   LEFT JOIN pairings pe
--   ON ge.pairing_id = pe.id
--   WHERE pe.enemy_country_id = p.my_country_id AND pe.my_country_id = p.enemy_country_id
--   ) enemy_goals,
--   (SELECT my_goals - enemy_goals
--   ) goal_deff
-- FROM pairings p
-- LEFT JOIN countries cm
-- ON cm.id = p.my_country_id
-- LEFT JOIN countries ce
-- ON ce.id = p.enemy_country_id
-- WHERE cm.group_name = 'C' AND ce.group_name = 'C'
-- ORDER BY p.kickoff, my_goals DESC;

-- 問１８
-- SELECT DATE_FORMAT(kickoff, '%Y-%m-%d %H:%i:%s') kickoff, DATE_FORMAT(DATE_SUB(kickoff, INTERVAL 12 HOUR), '%Y-%m-%d %H:%i:%s') kickoff_jp
-- FROM pairings p
-- WHERE p.my_country_id = 1 AND p.enemy_country_id = 4;

-- 問１９
-- SELECT TIMESTAMPDIFF(YEAR, birth, '2014-06-13') AS age, COUNT(id) player_count
-- FROM players 
-- GROUP BY age;