{extends file="layout.tpl"}
{block name="content"}
    <h1>Mastermind Board</h1>
    <h2>Pins to be guessed</h2>
    <div class="d-flex">
        {foreach $pinsToGuess as $pin}
            {$pin->showPin()}
        {/foreach}
    </div>
    {if $winner}
        <div class="alert alert-success" role="alert">
            Congratulations! You've won in {$attempts} attempts.
            <a href="index.php?action=startGameForm" class="btn btn-primary">Start a new game</a>
        </div>
    {/if}
    <h2>Guesses</h2>
    {if !empty($game->getGuesses())}
        {foreach $game->getGuesses() as $guess}
            <div class="row">
                <div class="col-md-4">
                    {foreach $guess->getPins() as $color}
                        <svg width="50" height="50">
                            <circle cx="25" cy="25" r="20"
                                    style="fill:{$color};stroke-width:10;stroke:rgb(0,0,0)"/>
                        </svg>
                    {/foreach}
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col">
                            <div class="badge bg-success">
                                Correct Position: {$guess->getCorrectPosition()}
                            </div>
                        </div>
                        <div class="col">
                            <div class="badge bg-warning">
                                Correct Color: {$guess->getCorrectColor()}
                            </div>
                        </div>
                        <div class="col">
                            <div class="badge bg-secondary">
                                Incorrect: {$guess->getIncorrect()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    {else}
        <p>No results yet.</p>
    {/if}

    {if !$winner}
        <h2>Pins chosen</h2>
        <div class="d-flex">
            {foreach $chosenPins as $index => $pin}
                <div id="pin_preview_{$index}">
                    {$pin->showPin()}
                </div>
            {/foreach}
        </div>
        <form action="index.php?action=addGuess" method="POST">
            {foreach $chosenPins as $index => $pin}
                <div class="form-group">
                    <label for="color_{$index}">Color for Pin {$index + 1}:</label>
                    <div class="d-flex align-items-center">
                        <div class="color-preview" id="color_preview_{$index}"
                             style="background-color: {$pin->getColor()}"></div>
                        <select class="form-control pin-selector" id="color_{$index}" name="pin_colors[]">
                            <!-- Add options for available pin colors -->
                            <option value="">Choose a color</option>
                            {foreach $colors as $color}
                                <option value="{$color}" {if $color eq $pin->getColor()}selected{/if}>{$color}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
            {/foreach}
            <button type="submit" class="btn btn-primary">Add Guess</button>
        </form>
    {/if}
{/block}