SELECT d.name, COUNT(*) AS hits
FROM domains d
LEFT OUTER JOIN hits h ON d.id = h.domain_id
WHERE d.created_at <= '2015-01-01'
AND (h.created_at >= '2015-01-01' AND h.created_at <= '2015-02-01')
GROUP BY d.name
ORDER BY hits DESC;