{extends file="layout.tpl"}
{block name="content"}
    <form action="index.php?action=startGame" method="POST">
        <div class="mb-3">
            <label for="amount" class="form-label">Amount of Pins</label>
            <input type="number" class="form-control" id="amount" name="amount">
        </div>
        <button type="submit" class="btn btn-primary">Start Game</button>
    </form>
{/block}