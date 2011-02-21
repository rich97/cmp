<?php
if (empty($multiplesOf)) {
    $multiplesOf = 10;
}
if ($multiplesOf < 2) {
    $multiplesOf = 2;
}

$limit = null;
if(!empty($this->params['paging'][$model]['options']['limit'])) {
    $limit = $this->params['paging'][$model]['options']['limit'];
};

if (!$limit) {
    $limit = $multiplesOf;
}

$string = '';
$selected_link_found = false;
for ($i = $multiplesOf; $i < $totalRecords; $i = $i+$i) {
    if($limit == $i) {
		$string .= $i . '&nbsp;|&nbsp;';
		$selected_link_found = true;
    } else {
		$string .= $this->Paginator->link($i, array('action' => 'index', 'limit' => $i)) . '&nbsp;|&nbsp;';
    }
}

if($selected_link_found === false) {
    $string .= 'All';
} else {
    $string .= $this->Paginator->link('All', array('action' => 'index', 'limit' => $totalRecords));
}

if (empty($searched)) {
    $searched = 'Search';
}

$out = $this->Form->create($model) .
    $this->Form->input('search', array('label' => false, 'div' => false, 'value' => $searched, 'id' => 'searchInput')) .
    $this->Form->submit('Search', array('class' => 'submit', 'div' => false)) .
    $this->Html->link('Clear', array('action' => 'clear_search')) .
$this->Form->end();

$li = $this->Html->tag('li', $out, array('class' => 'search'));
$li .= $this->Html->tag('li', '<b>Display</b> ' . $string, array('class' => 'pagination'));

echo $this->Html->tag('ul', $li, array('class' => 'searchbar clearfix'));
?>
