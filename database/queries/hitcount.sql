SELECT d.id, d.name, COUNT(*) AS hits
FROM domains d
LEFT OUTER JOIN hits h ON d.id = h.domain_id
WHERE (d.created_at BETWEEN '2015-04-14' AND NOW())
AND (h.created_at BETWEEN '2015-04-14' AND NOW())
GROUP BY d.name
ORDER BY d.name ASC
;