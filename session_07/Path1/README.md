<table>
<tr>
<th>Task</th>
<th>Topic</th>
<th>Question</th>
<th>Key Points</th>
<th>Conclusion</th>
</tr>

<tr>
<td><b>1</b></td>
<td>JOIN Distinction</td>
<td>INNER JOIN vs LEFT JOIN</td>
<td>
- INNER JOIN: only matching rows<br>
- LEFT JOIN: keeps all left rows<br>
- Unmatched → NULL
</td>
<td>❌ INNER JOIN removes unmatched<br>✅ LEFT JOIN keeps all data</td>
</tr>

<tr>
<td><b>2</b></td>
<td>Aggregation Logic</td>
<td>HAVING vs WHERE</td>
<td>
- WHERE: before grouping<br>
- HAVING: after grouping<br>
- No SUM() in WHERE
</td>
<td>📊 HAVING works with aggregated data</td>
</tr>

<tr>
<td><b>3</b></td>
<td>PDO</td>
<td>Definition & advantages</td>
<td>
- PHP Data Objects<br>
- Multi-database support<br>
- Prepared statements
</td>
<td>🔐 Flexible & secure</td>
</tr>

<tr>
<td><b>4</b></td>
<td>Security</td>
<td>Prepared Statements</td>
<td>
- Use placeholders<br>
- Separate SQL & data<br>
- Input = data only
</td>
<td>🛡 Prevents SQL Injection</td>
</tr>

<tr>
<td><b>5</b></td>
<td>Execution Flow</td>
<td>Query order</td>
<td>
FROM → WHERE → GROUP BY<br>
HAVING → SELECT → ORDER BY
</td>
<td>⚙️ WHERE before GROUP, HAVING after</td>
</tr>

</table>