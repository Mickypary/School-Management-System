<?php $widget = (is_superadmin_loggedin() ? '4' : '6'); ?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
				<div class="panel-heading">
                    <div class="panel-btn">
						<a href="javascript:void(0);" onclick="mfp_modal('#multipleImport')" class="btn btn-circle btn-default mb-sm">
							<i class="fas fa-plus-circle"></i> <?=translate('multiple_import')?>
						</a>
                    </div>
					<h4 class="panel-title">
						<i class="far fa-user-circle"></i> <?=translate('all_categories')?>
					</h4>
				</div>
			<?php echo form_open_multipart($this->uri->uri_string()); ?>
				<div class="panel-body">
				<?php if (count($enquiry){ ?>
				<div class="table-responsive mt-md mb-lg">
					<table class="table table-bordered table-condensed mb-none">
						<thead>
							<tr>
								<th>#</th>
								<th><?=translate('category')?></th>
								<th><?=translate('purpose')?></th>
								<th><?=translate('whom')?></th>
								<th><?=translate('roll')?></th>
								<th>IsAbsent</th>
							<?php
							$distributions = json_decode($timetable_detail['mark_distribution'], true);
							foreach ($distributions as $i => $value) {
								?>
								<th><?php echo get_type_name_by_id('exam_mark_distribution', $i) . " (" . $value['full_mark'] . ")" ?></th>
							<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; foreach ($student as $key => $row): ?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
								<td><?php echo get_type_name_by_id('student_category', $row['category_id']); ?></td>
								<td><?php echo $row['register_no']; ?></td>
								<td><?php echo $row['roll']; ?></td>
								<td>
									<div class="checkbox-replace"> 
										<label class="i-checks"><input type="checkbox" name="mark[<?=$key?>][absent]" <?=($row['get_abs'] == 'on' ? 'checked' : ''); ?>><i></i></label>
									</div>
								</td>
								<?php
								$getDetails = json_decode($row['get_mark'], true);
								foreach ($distributions as $id => $ass) {
									$existMark = isset($getDetails[$id]) ? $getDetails[$id]  : '';
									?>
								<td class="min-w-sm">
									<div class="form-group">
										<input type="text" class="form-control" autocomplete="off" name="mark[<?=$key?>][assessment][<?=$id?>]" value="<?=$existMark?>">
										<span class="error"></span>
									</div>
								</td>
								<?php } ?>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?php } else { echo '<div class="alert alert-subl mt-md text-center">' . translate('no_information_available') . '</div>'; } ?>
			</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-offset-10 col-md-2">
							<button type="submit" name="submit" value="save" class="btn btn btn-default btn-block"> <i class="fas fa-plus-circle"></i> <?=translate('save')?></button>
						</div>
					</div>
				</footer>
			<?php echo form_close();?>
		</section>
	</div>
</div>