SELECT referer, count(*)
FROM hits
WHERE referer is not null
AND domain_id = 18
GROUP BY referer
ORDER BY referer;
