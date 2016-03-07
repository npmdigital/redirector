SELECT d.id, d.name, COUNT(*) AS hits
FROM domains d
LEFT OUTER JOIN hits h ON d.id = h.domain_id
WHERE d.created_at <= '2015-06-01'
AND (h.created_at >= '2015-06-01' AND h.created_at <= '2015-07-01')
GROUP BY d.name
ORDER BY d.name ASC;