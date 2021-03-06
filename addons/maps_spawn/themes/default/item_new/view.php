<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>ดู Item</h2>
<?php if ($item): ?>
<?php $icon = $this->iconImage($item->item_id); ?>
<h3>
	<?php if ($icon): ?><img src="<?php echo $icon ?>" /><?php endif ?>
	#<?php echo htmlspecialchars($item->item_id) ?>: <?php echo htmlspecialchars($item->name) ?>
</h3>
<table class="vertical-table">
	<tr>
		<th>ID</th>
		<td><?php echo htmlspecialchars($item->item_id) ?></td>
		<?php if ($image=$this->itemImage($item->item_id)): ?>
		<td rowspan="<?php echo ($server->isRenewal)?9:8 ?>" style="width: 150px; text-align: center; vertical-alignment: middle">
			<img src="<?php echo $image ?>" />
		</td>
		<?php endif ?>
		<th>สำหรับขาย</th>
		<td>
			<?php if ($item->cost): ?>
				<span class="for-sale yes">
					ใช่
				</span>
			<?php else: ?>
				<span class="for-sale no">
					ไม่
				</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>Identifier</th>
		<td><?php echo htmlspecialchars($item->identifier) ?></td>
		<th>ราคาเครดิต</th>
		<td>
			<?php if ($item->cost): ?>
				<?php echo number_format((int)$item->cost) ?>
			<?php else: ?>
				<span class="not-applicable">ไม่ขาย</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>ชื่อ</th>
		<td><?php echo htmlspecialchars($item->name) ?></td>
		<th>ประเภท</th>
		<td><?php echo $this->itemTypeText($item->type, $item->view) ?></td>
	</tr>
	<tr>
		<th>ซื้อ NPC</th>
		<td><?php echo number_format((int)$item->price_buy) ?></td>
		<th>น้ำหนัก</th>
		<td><?php echo round($item->weight, 1) ?></td>
	</tr>
	<tr>
		<th>ขาย NPC</th>
		<td>
			<?php if (is_null($item->price_sell) && $item->price_buy): ?>
				<?php echo number_format(floor($item->price_buy / 2)) ?>
			<?php else: ?>
				<?php echo number_format((int)$item->price_sell) ?>
			<?php endif ?>
		</td>
		<th>อาวุธเลเวล</th>
		<td><?php echo number_format((int)$item->weapon_level) ?></td>
	</tr>
	<tr>
		<th>ระยะ</th>
		<td><?php echo number_format((int)$item->range) ?></td>
		<th>ป้องกัน</th>
		<td><?php echo number_format((int)$item->defence) ?></td>
	</tr>
	<tr>
		<th>ช่อง</th>
		<td><?php echo number_format((int)$item->slots) ?></td>
		<th>ปรับแต่ง</th>
		<td>
			<?php if ($item->refineable): ?>
				ใช่
			<?php else: ?>
				ไม่
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>โจมตี</th>
		<td><?php echo number_format((int)$item->attack) ?></td>
		<th>เลเวลขั้นต่ำสวมใส่ได้</th>
		<td><?php echo number_format((int)$item->equip_level_min) ?></td>
	</tr>
	<?php if($server->isRenewal): ?>
	<tr>
		<th>โจมตีเวทย์</th>
		<td><?php echo number_format((int)$item->matk) ?></td>
		<th>เลเวลสูงสุดสวมใส่ได้</th>
		<td>
			<?php if ($item->equip_level_max == 0): ?>
				<span class="not-applicable">ปกติ</span>
			<?php else: ?>
				<?php echo number_format((int)$item->equip_level_max) ?>
			<?php endif ?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
		<th>ตำแหน่งสวมใส่</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($locs=$this->equipLocations($item->equip_locations)): ?>
				<?php echo htmlspecialchars(implode(' + ', $locs)) ?>
			<?php else: ?>
				<span class="not-applicable">ปกติ</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>สำหรับคลาส</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($upper=$this->equipUpper($item->equip_upper)): ?>
				<?php echo htmlspecialchars(implode(' / ', $upper)) ?>
			<?php else: ?>
				<span class="not-applicable">ปกติ</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>สำหรับอาชีพ</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($jobs=$this->equippableJobs($item->equip_jobs)): ?>
				<?php echo htmlspecialchars(implode(' / ', $jobs)) ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>เพศ</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($item->equip_genders === '0'): ?>
				หญิง
			<?php elseif ($item->equip_genders === '1'): ?>
				ชาย
			<?php elseif ($item->equip_genders === '2'): ?>
				ทั้งคู่ (ชายและหญิง)
			<?php else: ?>
				<span class="not-applicable">ไม่รู้จัก</span>
			<?php endif ?>
		</td>
	</tr>
	<?php if (($isCustom && $auth->allowedToSeeItemDb2Scripts) || (!$isCustom && $auth->allowedToSeeItemDbScripts)): ?>
	<tr>
		<th>Item Use Script</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->script)): ?>
				<?php echo $script ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>Equip Script</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->equip_script)): ?>
				<?php echo $script ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>Unequip Script</th>
		<td colspan="<?php echo $image ? 4 : 3 ?>">
			<?php if ($script=$this->displayScript($item->unequip_script)): ?>
				<?php echo $script ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
	</tr>
	<?php endif ?>
</table>
<?php if ($itemDrops): ?>
<h3><?php echo htmlspecialchars($item->name) ?> Dropped By</h3>
<table class="vertical-table">
	<tr>
		<th>Monster ID</th>
		<th>Monster Name</th>
		<th><?php echo htmlspecialchars($item->name) ?> Drop Chance</th>
		<th>Monster Level</th>
		<th>Monster Race</th>
		<th>Monster Element</th>
	</tr>
	<?php foreach ($itemDrops as $itemDrop): ?>
	<tr class="item-drop-<?php echo $itemDrop['type'] ?>">
		<td align="right">
			<?php if ($auth->actionAllowed('monster', 'view')): ?>
				<?php echo $this->linkToMonster($itemDrop['monster_id'], $itemDrop['monster_id']) ?>
			<?php else: ?>
				<?php echo $itemDrop['monster_id'] ?>
			<?php endif ?>
		</td>
		<td>
			<?php if ($itemDrop['type'] == 'mvp'): ?>
				<span class="mvp">MVP!</span>
			<?php endif ?>
			<?php echo htmlspecialchars($itemDrop['monster_name']) ?>
		</td>
		<td><strong><?php echo $itemDrop['drop_chance'] ?>%</strong></td>
		<td><?php echo number_format($itemDrop['monster_level']) ?></td>
		<td><?php echo Flux::monsterRaceName($itemDrop['monster_race']) ?></td>
		<td>
			Level <?php echo floor($itemDrop['monster_ele_lv']) ?>
			<em><?php echo Flux::elementName($itemDrop['monster_element']) ?></em>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>


	<!-- ITEM SHOP -->
	<?php if($itemShop !== false): ?>
		<h3><?=$item->name?>   ซื้อได้ที่</h3>
		<?php if(sizeof($itemShop)): ?>
			<table class="vertical-table">
    <tr>
        <th>ชื่อ</th>
        <th>แผนที่</th>
        <th>พิกัด</th>
        <th>ราคาขาย</th>
    </tr>
    <?php foreach($itemShop as $it){ ?>
        <tr>
			<?php if($auth->actionAllowed('npcs', 'view')){ ?>
            	<td><a href="<?=$this->url('npcs', 'view', array('id' => $it->id))?>"><?=$it->name?></a></td>
			<?php } else { ?>
				<td><?=$it->name?></td>
			<?php } ?>
			<?php if($auth->actionAllowed('map', 'view')){ ?>
            	<td><a href="<?=$this->url('map', 'view', array('map' => $it->map))?>"><?=$it->map?></a></td>
			<?php } else { ?>
				<td><?=$it->map?></td>
			<?php } ?>
            <td><?=$it->x?>,<?=$it->y?></td>
            <td><?=$it->price?></td>
        </tr>
    <?php } ?>
			</table>
		<?php else: ?>
			ไอเท็มนี้ไม่สามารถซื้อได้
		<?php endif ?>
	<?php endif ?>
	<!-- ITEM SHOP -->


<?php else: ?>
<p>ไม่พบไอเท็มดังกล่าว <a href="javascript:history.go(-1)">ย้อนกลับ</a></p>
<?php endif ?>