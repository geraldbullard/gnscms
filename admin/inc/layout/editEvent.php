    <div class="row-fluid">
      <div id="leftNav" class="box span3" style="margin-bottom:15px;">
        <div class="box-header well">
          <h2><i class="icon-th"></i> Navigation</h2>
          <div class="box-icon">
            <i class="icon-chevron-left" onclick="toggleLeftNav();" style="margin:6px 20px 0px -35px; cursor:pointer;" title="Hide Navigation"></i>
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="box-content">
          <?php include('inc/menu.php'); ?>  
        </div>
      </div>
      <div id="rightContent" class="box span9">
        <div id="info" style="display:none;"></div>
        <div class="box-header well">
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="Show Navigation"></i><i class="icon-th"></i> Edit Event : : <?php echo $results['event']->title; ?></h2>
          <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="box-content">
          <ul class="nav nav-tabs" id="editEventTab">
            <li class="active"><a href="#editEvent"><i class="icon-pencil"></i> Edit Event</a></li>
          </ul>
          <div class="tab-event pad-10">
            <div class="tab-pane active" id="editEvent">
              <?php if ( isset( $results['errorMessage'] ) ) { ?>
              <div class="alert alert-error" id="errorMessage">
                <button class="close" data-dismiss="alert" type="button">x</button>
                <?php echo $results['errorMessage'] ?>
              </div>
              <?php } ?>           
              <div class="row-fluid span12">
                <form action="index.php?action=editEvent" name="editEvent" method="post">
                  <input type="hidden" name="editId" value="<?php echo $results['event']->id; ?>"/>
                  <div class="row-fluid">
                    <div class="span4">
                      <label>Title</label>
                      <input class="span12" type="text" name="title" maxlength="255" value="<?php echo htmlspecialchars( $results['event']->title ); ?>" autofocus required />
                    </div>
                  </div>
                  <div class="row-fluid" style="margin-bottom:10px;">
                    <div class="span8">
                      <label>Description <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                      <textarea class="span12 ckeditor" name="description">
                        <?php echo htmlspecialchars( $results['event']->description ); ?>
                      </textarea>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span4">
                      <label>Date <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                      <input class="span12 datepicker" type="text" name="eventDate" value="<?php echo $results['event']->eventDate; ?>" />
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span4">
                      <label>Start <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                      <select class="span12" name="startTime">
                        <?php
                          $min = array("00","15","30","45");
                          $startOptions = '';
                          for ($a=0; $a<10; $a++) {
                            foreach ($min as $v) {
                              $startOptionsAm1 = '<option value="' . $a . ':' . $v . ' AM"' . (($results['event']->startTime == $a . ':' . $v . ' AM') ? ' selected="selected"' : null) . '>' . $a . ':' . $v . ' AM</option>';
                              $startOptionsAm1 = str_replace(array("0:00", "0:15", "0:30", "0:45"), array("12:00", "12:15", "12:30", "12:45"), $startOptionsAm1);
                              $startOptions .= $startOptionsAm1;
                            }
                          }
                          for ($a=10; $a<13; $a++) {
                            foreach ($min as $v) {
                              $startOptionsAm2 = '<option value="' . $a . ':' . $v . ' AM"' . (($results['event']->startTime == $a . ':' . $v . ' AM') ? ' selected="selected"' : null) . '>' . $a . ':' . $v . ' AM</option>';
                              $startOptions .= $startOptionsAm2;
                            }
                          }
                          for ($p=0; $p<10; $p++) {
                            foreach ($min as $v) {
                              $startOptionsPm1 = '<option value="' . $p . ':' . $v . ' PM"' . (($results['event']->startTime == $p . ':' . $v . ' PM') ? ' selected="selected"' : null) . '>' . $p . ':' . $v . ' PM</option>';
                              $startOptionsPm1 = str_replace(array("0:00", "0:15", "0:30", "0:45"), array("12:00", "12:15", "12:30", "12:45"), $startOptionsPm1);
                              $startOptions .= $startOptionsPm1;
                            }
                          }
                          for ($p=10; $p<13; $p++) {
                            foreach ($min as $v) {
                              $startOptionsPm2 = '<option value="' . $p . ':' . $v . ' PM"' . (($results['event']->startTime == $p . ':' . $v . ' PM') ? ' selected="selected"' : null) . '>' . $p . ':' . $v . ' PM</option>';
                              $startOptions .= $startOptionsPm2;
                            }
                          }
                          echo $startOptions;
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span4">
                      <label>End <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                      <select class="span12 hasTimepicker" type="text" name="endTime">
                        <?php
                          $endOptions = '';
                          for ($a=0; $a<10; $a++) {
                            foreach ($min as $v) {
                              $endOptionsAm1 = '<option value="' . $a . ':' . $v . ' AM"' . (($results['event']->endTime == $a . ':' . $v . ' AM') ? ' selected="selected"' : null) . '>' . $a . ':' . $v . ' AM</option>';
                              $endOptionsAm1 = str_replace(array("0:00", "0:15", "0:30", "0:45"), array("12:00", "12:15", "12:30", "12:45"), $endOptionsAm1);
                              $endOptions .= $endOptionsAm1;
                            }
                          }
                          for ($a=10; $a<13; $a++) {
                            foreach ($min as $v) {
                              $endOptionsAm2 = '<option value="' . $a . ':' . $v . ' AM"' . (($results['event']->endTime == $a . ':' . $v . ' AM') ? ' selected="selected"' : null) . '>' . $a . ':' . $v . ' AM</option>';
                              $endOptions .= $endOptionsAm2;
                            }
                          }
                          for ($p=0; $p<10; $p++) {
                            foreach ($min as $v) {
                              $endOptionsPm1 = '<option value="' . $p . ':' . $v . ' PM"' . (($results['event']->endTime == $p . ':' . $v . ' PM') ? ' selected="selected"' : null) . '>' . $p . ':' . $v . ' PM</option>';
                              $endOptionsPm1 = str_replace(array("0:00", "0:15", "0:30", "0:45"), array("12:00", "12:15", "12:30", "12:45"), $endOptionsPm1);
                              $endOptions .= $endOptionsPm1;
                            }
                          }
                          for ($p=10; $p<13; $p++) {
                            foreach ($min as $v) {
                              $endOptionsPm2 = '<option value="' . $p . ':' . $v . ' PM"' . (($results['event']->endTime == $p . ':' . $v . ' PM') ? ' selected="selected"' : null) . '>' . $p . ':' . $v . ' PM</option>';
                              $endOptions .= $endOptionsPm2;
                            }
                          }
                          echo $endOptions;
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span4">
                      <label>Location <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                      <input class="span12" type="text" name="location" value="<?php echo htmlspecialchars( $results['event']->location ); ?>" />
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="span4">
                      <label>Map <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                      <input class="span12" type="text" name="map" value="<?php echo htmlspecialchars( $results['event']->map ); ?>" />
                    </div>
                  </div>
                  <div class="row-fluid">&nbsp;</div>             
                  <input type="hidden" name="status" value="<?php echo $results['event']->status; ?>"/>
                  <div class="row-fluid span12" style="margin:0 0 10px 0;">
                    <div style="float:left;">
                      <input class="btn btn-primary" type="submit" name="saveChanges" value="Save Changes" /> &nbsp; <input class="btn btn-primary" type="submit" formnovalidate name="cancel" value="Cancel" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div><!--/row-->
