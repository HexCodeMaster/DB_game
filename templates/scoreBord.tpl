<!DOCTYPE html>
<html lang="en">
<head>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Scores</title>
        <style>
            table {
                width: 50%;
                border-collapse: collapse;
                margin: 25px 0;
                font-size: 18px;
                text-align: left;
            }
            th, td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>

    <h2>User Scores</h2>

    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Game Score</th>
        </tr>
        {foreach $user_scores as $score}
            <tr>
                <td>{$score.user_id}</td>
                <td>{$score.username}</td>
                <td>{$score.score}</td>
            </tr>
        {/foreach}
    </table>

    </body>
    </html>