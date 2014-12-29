SELECT d.name, COUNT(*) AS hits
FROM domains d
LEFT OUTER JOIN hits h ON d.id = h.domain_id
GROUP BY d.name
ORDER BY hits DESC;