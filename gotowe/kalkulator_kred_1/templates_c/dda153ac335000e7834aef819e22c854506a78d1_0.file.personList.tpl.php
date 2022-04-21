<?php
/* Smarty version 4.1.0, created on 2022-04-21 16:03:50
  from 'C:\int\htdocs\kalkulator_kred_1\app\views\personList.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_62616446062b91_01025800',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dda153ac335000e7834aef819e22c854506a78d1' => 
    array (
      0 => 'C:\\int\\htdocs\\kalkulator_kred_1\\app\\views\\personList.tpl',
      1 => 1650549612,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62616446062b91_01025800 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21238298776261644605aae8_71350329', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.html");
}
/* {block 'content'} */
class Block_21238298776261644605aae8_71350329 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_21238298776261644605aae8_71350329',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



<td>
			<a class="button-small pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
personNew">Dodaj wpis</a>
			&nbsp;
			<a class="button-small pure-button button-warning" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcShow">Powrót</a>
		</td>

<br/>
</br>

<table id="tab_people" class="pure-table pure-table-bordered">
<thead>
	<tr>
		<th>imię</th>
		<th>nazwisko</th>
		<th>rata</th>
		<th>opcje</th>
	</tr>
</thead>




<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['people']->value, 'p');
$_smarty_tpl->tpl_vars['p']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->do_else = false;
?>
<tr><td><?php echo $_smarty_tpl->tpl_vars['p']->value["name"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['p']->value["surname"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['p']->value["installment"];?>
</td><td><a class="button-small pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
personEdit&id=<?php echo $_smarty_tpl->tpl_vars['p']->value['idperson'];?>
">Edytuj</a>&nbsp;<a class="button-small pure-button button-warning" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
personDelete&id=<?php echo $_smarty_tpl->tpl_vars['p']->value['idperson'];?>
">Usuń</a></td></tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tbody>
</table>


</div>
<?php
}
}
/* {/block 'content'} */
}
