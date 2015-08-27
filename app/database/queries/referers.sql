SELECT referer, count(*)
FROM hits
WHERE domain_id = 22
GROUP BY referer
ORDER BY count(*) DESC;
