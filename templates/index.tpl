{extends file="layout.tpl"}
{block name="content"}
<style>
    .game {
        display: flex;
        flex-direction: column;
        width: 50%;
        padding: 1rem;
    }

    .price ins {
        margin-left: -.3rem;
        margin-right: .5rem;
    }



    .creator ins {
        color: #a89ec9;
        text-decoration: none;
    }
    .creator .wrapper {
        display: flex;
        align-items: center;
        border: 1px solid #ffffff22;
        padding: .3rem;
        margin: 0 .5rem 0 0;
        border-radius: 100%;
        box-shadow: inset 0 0 0 4px #000000aa;
    }
    .creator .wrapper img {
        border-radius: 100%;
        border: 1px solid #ffffff22;
        width: 1rem;
        height: 2rem;
        object-fit: cover;
        margin: 0;
    }
    ::before {
        position: fixed;
        content: "";
        box-shadow: 0 0 100px 40px #ffffff08;
        top: -10%;
        left: -100%;
        transform: rotate(-45deg);
        height: 60rem;
        transition: .7s all;
    }
    .game:hover {
        border: 1px solid #ffffff44;
        box-shadow: 0 7px 50px 10px #000000aa;
        transform: scale(1.015);
        filter: brightness(1.3);
    }
    .game:hover::before {
        filter: brightness(.5);
        top: -100%;
        left: 20%;
    }
</style>
    <h1 class="text-xl-center p-5 ">Welcome  <span style="background-color: chocolate"> &nabla;Back </span>{$smarty.session.username|default:'Guest'} </h1>
    <div class="d-flex p-5 gap-3 ">

        <a class="game  nav-link" href="index.php?action=startGameForm">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="./templates/img/bg-color-memory-game.png" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Mastermind Board</h5>
                    <p class="card-text">This is a game that you simply guss the name of the card.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3years ago</small></p>
                </div>
            </div>
        </div>
    </div>
</a>
        <a class=" nav-link" href="#?">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="./templates/img/score-icon-png-15.jpg.png" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Score Board</h5>
                            <p class="card-text">
                            <table>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Game Score</th>
                                </tr>
                                {if isset($userScores) && !empty($userScores)}
                                    {foreach from=$userScores item=score}
                                        <tr>
                                            <td>{$score.user_id}</td>
                                            <td>{$score.username}</td>
                                            <td>{$score.game_score}</td>
                                        </tr>
                                    {/foreach}
                                {else}
                                    <tr>
                                        <td colspan="3">No scores available</td>
                                    </tr>
                                {/if}
                            </table>
                            </p>
                            <p class="card-text"><small class="text-muted"></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>




{/block}
