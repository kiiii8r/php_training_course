USE cafe;

-- 問１
-- SELECT group_name AS 'グループ', MIN(ranking) AS 'ランキング最上位', MAX(ranking) AS 'ランキング最下位'
-- FROM countries
-- GROUP BY group_name;

-- 問２
-- SELECT AVG(height) AS '平均身長', AVG(weight) AS '平均体重'
-- FROM players
-- WHERE position = 'GK';