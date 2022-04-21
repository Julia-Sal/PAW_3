{extends file="main.html"}


{block name=content}


<td>
			<a class="button-small pure-button button-secondary" href="{$conf->action_root}personNew">Dodaj wpis</a>
			&nbsp;
			<a class="button-small pure-button button-warning" href="{$conf->action_root}calcShow">Powrót</a>
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




{foreach $people as $p}
{strip}
	<tr>
		<td>{$p["name"]}</td>
		<td>{$p["surname"]}</td>
		<td>{$p["installment"]}</td>
		<td>
			<a class="button-small pure-button button-secondary" href="{$conf->action_url}personEdit&id={$p['idperson']}">Edytuj</a>
			&nbsp;
			<a class="button-small pure-button button-warning" href="{$conf->action_url}personDelete&id={$p['idperson']}">Usuń</a>
		</td>
	</tr>
{/strip}
{/foreach}
</tbody>
</table>


</div>
{/block}