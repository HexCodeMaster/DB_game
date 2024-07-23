<?php
/* Smarty version 4.5.2, created on 2024-07-23 14:21:18
  from '/Applications/MAMP/htdocs/oopdb-main-main copy/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_669fbc5e6f0ba6_06251615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '03400ac1759dfd2b3fbd101477eecc937bf78bc8' => 
    array (
      0 => '/Applications/MAMP/htdocs/oopdb-main-main copy/templates/index.tpl',
      1 => 1718189881,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_669fbc5e6f0ba6_06251615 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1524755318669fbc5e6cf909_44560048', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layout.tpl");
}
/* {block "content"} */
class Block_1524755318669fbc5e6cf909_44560048 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1524755318669fbc5e6cf909_44560048',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

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
    <h1 class="text-xl-center p-5 ">Welcome  <span style="background-color: chocolate"> &nabla;Back </span><?php echo (($tmp = $_SESSION['username'] ?? null)===null||$tmp==='' ? 'Guest' ?? null : $tmp);?>
 </h1>
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
                                <?php if ((isset($_smarty_tpl->tpl_vars['userScores']->value)) && !empty($_smarty_tpl->tpl_vars['userScores']->value)) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['userScores']->value, 'score');
$_smarty_tpl->tpl_vars['score']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['score']->value) {
$_smarty_tpl->tpl_vars['score']->do_else = false;
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['score']->value['user_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['score']->value['username'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['score']->value['game_score'];?>
</td>
                                        </tr>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="3">No scores available</td>
                                    </tr>
                                <?php }?>
                            </table>
                            </p>
                            <p class="card-text"><small class="text-muted"></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>




<?php
}
}
/* {/block "content"} */
}
