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
