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
        <div class="box-header well">
          <h2><i class="icon-chevron-right" onclick="toggleLeftNav();" style="display:none; cursor:pointer;" title="Show Navigation"></i><i class="icon-th"></i> Manage Events</h2>
          <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          </div>
        </div>
        <div class="box-content">
          <?php if (isset($results['errorMessage']) || isset($results['successMessage'])) { ?>
          <div>
            <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="alert alert-error" id="errorMessage">
              <button class="close" data-dismiss="alert" type="button">x</button>
              <?php echo $results['errorMessage'] ?>
            </div>
            <?php } ?>
            <?php if ( isset( $results['successMessage'] ) ) { ?>
            <div class="alert alert-success" id="successMessage">
              <button class="close" data-dismiss="alert" type="button">x</button>
              <?php echo $results['successMessage'] ?>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
          <ul class="nav nav-tabs" id="listEventsTab">
            <li class="active"><a href="#currentEventsTab"><i class="icon icon-color icon-book-empty"></i> Current Events</a></li>
            <li><a href="#newEventsTab"><i class="icon icon-color icon-plus"></i> Add New Event</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="currentEventsTab">
              <h4>Events</h4><br />
              <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                <thead>
                  <tr>
                    <td class="hide-below-480 table-id-head" style="width:2.5%;">ID</td>
                    <td class="table-title-head">Title</td>
                    <td class="hide-below-480 table-date-head" style="width:10%;">Date <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></td>
                    <td class="hide-below-480 table-status-head" style="width:10%;">Status <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></td>
                    <td class="table-actions-head" style="text-align:right;" style="width:20%;">Actions <i class="icon-info-sign" data-rel="popover" data-placement="left" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></td>
                  </tr>
                </thead>
                <tbody id="event-list">
                  <?php
                    foreach ( $results['events'] as $event ) {
                  ?>
                  <tr id="listItem_<?php echo $event->id; ?>">
                    <td class="hide-below-480" title="Event ID" data-rel="tooltip">
                      <?php echo $event->id; ?>
                    </td>
                    <td title="Event Title">
                      <?php echo $event->title; ?>
                    </td>
                    <td title="Event Date">
                      <?php echo $event->eventDate; ?>
                    </td>
                    <td class="hide-below-480 noDecoration">
                      <?php if ($event->status == 1) { ?>
                      <div id="status_<?php echo $event->id; ?>"><a onclick="disableEvent(<?php echo $event->id; ?>);"><span class="label label-success">Enabled</span></a></div>
                      <?php } else { ?>
                      <div id="status_<?php echo $event->id; ?>"><a onclick="enableEvent(<?php echo $event->id; ?>);"><span class="label label-important">Disabled</span></a></div>
                      <?php } ?>
                    </td>
                    <td style="text-align:right; white-space:nowrap;">
                      <a href="index.php?action=editEvent&amp;editId=<?php echo $event->id; ?>" title="Edit this Event" data-rel="tooltip" class="btn btn-info">
                        <i class="icon-edit icon-white"></i>
                        <span class="hide-below-768">Edit</span>
                      </a>
                      <a title="Copy this Event" data-rel="tooltip" class="btn btn-primary btn-copy" id="btn_copy_<?php echo $event->id; ?>">
                        <i class="icon-asterisk icon-white"></i>
                      </a>
                      <a onclick="deleteEvent(<?php echo $event->id; ?>);" title="Delete this Event" data-rel="tooltip" class="btn btn-danger">
                        <i class="icon-trash icon-white"></i>
                      </a>
                    </td>
                  </tr>
                  <?php 
                    }
                  ?>
                </tbody>
              </table>
              <div id="updateSortChanges" style="display:none; margin-bottom:10px;">
                <a onclick="location.reload();" title="Update Sort Changes" data-rel="tooltip" class="btn btn-success">
                  <i class="icon icon-arrowrefresh-e icon-white"></i> 
                  <span class="hide-below-768">Update Sort Changes</span>
                </a>
              </div>
              <p><strong>( <?php echo $results['totalEvents']; ?> )</strong> event<?php echo ( $results['totalEvents'] != 1 ) ? 's' : '' ?> total</p>
            </div>
            <div class="tab-pane" id="newEventsTab">
              <form action="index.php?action=newEvent" method="post" name="newEvent" id="newEvent">
                <div class="row-fluid">
                  <div class="span4">
                    <label>Title <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <input class="span12" type="text" name="title" autofocus required />
                  </div>
                </div>
                <div class="row-fluid" style="margin-bottom:10px;">
                  <div class="span8">
                    <label>Description <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <textarea class="span12 ckeditor" name="description"></textarea>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Date <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <input class="span12 datepicker" type="text" name="eventDate" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Start <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <select class="span12" name="startTime">
                      <option value="12:00 AM">12:00 AM</option>
                      <option value="12:15 AM">12:15 AM</option>
                      <option value="12:30 AM">12:30 AM</option>
                      <option value="12:45 AM">12:45 AM</option>
                      <option value="01:00 AM">01:00 AM</option>
                      <option value="01:15 AM">01:15 AM</option>
                      <option value="01:30 AM">01:30 AM</option>
                      <option value="01:45 AM">01:45 AM</option>
                      <option value="02:00 AM">02:00 AM</option>
                      <option value="02:15 AM">02:15 AM</option>
                      <option value="02:30 AM">02:30 AM</option>
                      <option value="02:45 AM">02:45 AM</option>
                      <option value="03:00 AM">03:00 AM</option>
                      <option value="03:15 AM">03:15 AM</option>
                      <option value="03:30 AM">03:30 AM</option>
                      <option value="03:45 AM">03:45 AM</option>
                      <option value="04:00 AM">04:00 AM</option>
                      <option value="04:15 AM">04:15 AM</option>
                      <option value="04:30 AM">04:30 AM</option>
                      <option value="04:45 AM">04:45 AM</option>
                      <option value="05:00 AM">05:00 AM</option>
                      <option value="05:15 AM">05:15 AM</option>
                      <option value="05:30 AM">05:30 AM</option>
                      <option value="05:45 AM">05:45 AM</option>
                      <option value="06:00 AM">06:00 AM</option>
                      <option value="06:15 AM">06:15 AM</option>
                      <option value="06:30 AM">06:30 AM</option>
                      <option value="06:45 AM">06:45 AM</option>
                      <option value="07:00 AM">07:00 AM</option>
                      <option value="07:15 AM">07:15 AM</option>
                      <option value="07:30 AM">07:30 AM</option>
                      <option value="07:45 AM">07:45 AM</option>
                      <option value="08:00 AM">08:00 AM</option>
                      <option value="08:15 AM">08:15 AM</option>
                      <option value="08:30 AM">08:30 AM</option>
                      <option value="08:45 AM">08:45 AM</option>
                      <option value="09:00 AM">09:00 AM</option>
                      <option value="09:15 AM">09:15 AM</option>
                      <option value="09:30 AM">09:30 AM</option>
                      <option value="09:45 AM">09:45 AM</option>
                      <option value="10:00 AM">10:00 AM</option>
                      <option value="10:15 AM">10:15 AM</option>
                      <option value="10:30 AM">10:30 AM</option>
                      <option value="10:45 AM">10:45 AM</option>
                      <option value="11:00 AM">11:00 AM</option>
                      <option value="11:15 AM">11:15 AM</option>
                      <option value="11:30 AM">11:30 AM</option>
                      <option value="11:45 AM">11:45 AM</option>
                      <option value="12:00 PM">12:00 PM</option>
                      <option value="12:15 PM">12:15 PM</option>
                      <option value="12:30 PM">12:30 PM</option>
                      <option value="12:45 PM">12:45 PM</option>
                      <option value="01:00 PM">01:00 PM</option>
                      <option value="01:15 PM">01:15 PM</option>
                      <option value="01:30 PM">01:30 PM</option>
                      <option value="01:45 PM">01:45 PM</option>
                      <option value="02:00 PM">02:00 PM</option>
                      <option value="02:15 PM">02:15 PM</option>
                      <option value="02:30 PM">02:30 PM</option>
                      <option value="02:45 PM">02:45 PM</option>
                      <option value="03:00 PM">03:00 PM</option>
                      <option value="03:15 PM">03:15 PM</option>
                      <option value="03:30 PM">03:30 PM</option>
                      <option value="03:45 PM">03:45 PM</option>
                      <option value="04:00 PM">04:00 PM</option>
                      <option value="04:15 PM">04:15 PM</option>
                      <option value="04:30 PM">04:30 PM</option>
                      <option value="04:45 PM">04:45 PM</option>
                      <option value="05:00 PM">05:00 PM</option>
                      <option value="05:15 PM">05:15 PM</option>
                      <option value="05:30 PM">05:30 PM</option>
                      <option value="05:45 PM">05:45 PM</option>
                      <option value="06:00 PM">06:00 PM</option>
                      <option value="06:15 PM">06:15 PM</option>
                      <option value="06:30 PM">06:30 PM</option>
                      <option value="06:45 PM">06:45 PM</option>
                      <option value="07:00 PM">07:00 PM</option>
                      <option value="07:15 PM">07:15 PM</option>
                      <option value="07:30 PM">07:30 PM</option>
                      <option value="07:45 PM">07:45 PM</option>
                      <option value="08:00 PM">08:00 PM</option>
                      <option value="08:15 PM">08:15 PM</option>
                      <option value="08:30 PM">08:30 PM</option>
                      <option value="08:45 PM">08:45 PM</option>
                      <option value="09:00 PM">09:00 PM</option>
                      <option value="09:15 PM">09:15 PM</option>
                      <option value="09:30 PM">09:30 PM</option>
                      <option value="09:45 PM">09:45 PM</option>
                      <option value="10:00 PM">10:00 PM</option>
                      <option value="10:15 PM">10:15 PM</option>
                      <option value="10:30 PM">10:30 PM</option>
                      <option value="10:45 PM">10:45 PM</option>
                      <option value="11:00 PM">11:00 PM</option>
                      <option value="11:15 PM">11:15 PM</option>
                      <option value="11:30 PM">11:30 PM</option>
                      <option value="11:45 PM">11:45 PM</option>
                    </select>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>End <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <select class="span12 hasTimepicker" type="text" name="endTime">
                      <option value="12:00 AM">12:00 AM</option>
                      <option value="12:15 AM">12:15 AM</option>
                      <option value="12:30 AM">12:30 AM</option>
                      <option value="12:45 AM">12:45 AM</option>
                      <option value="01:00 AM">01:00 AM</option>
                      <option value="01:15 AM">01:15 AM</option>
                      <option value="01:30 AM">01:30 AM</option>
                      <option value="01:45 AM">01:45 AM</option>
                      <option value="02:00 AM">02:00 AM</option>
                      <option value="02:15 AM">02:15 AM</option>
                      <option value="02:30 AM">02:30 AM</option>
                      <option value="02:45 AM">02:45 AM</option>
                      <option value="03:00 AM">03:00 AM</option>
                      <option value="03:15 AM">03:15 AM</option>
                      <option value="03:30 AM">03:30 AM</option>
                      <option value="03:45 AM">03:45 AM</option>
                      <option value="04:00 AM">04:00 AM</option>
                      <option value="04:15 AM">04:15 AM</option>
                      <option value="04:30 AM">04:30 AM</option>
                      <option value="04:45 AM">04:45 AM</option>
                      <option value="05:00 AM">05:00 AM</option>
                      <option value="05:15 AM">05:15 AM</option>
                      <option value="05:30 AM">05:30 AM</option>
                      <option value="05:45 AM">05:45 AM</option>
                      <option value="06:00 AM">06:00 AM</option>
                      <option value="06:15 AM">06:15 AM</option>
                      <option value="06:30 AM">06:30 AM</option>
                      <option value="06:45 AM">06:45 AM</option>
                      <option value="07:00 AM">07:00 AM</option>
                      <option value="07:15 AM">07:15 AM</option>
                      <option value="07:30 AM">07:30 AM</option>
                      <option value="07:45 AM">07:45 AM</option>
                      <option value="08:00 AM">08:00 AM</option>
                      <option value="08:15 AM">08:15 AM</option>
                      <option value="08:30 AM">08:30 AM</option>
                      <option value="08:45 AM">08:45 AM</option>
                      <option value="09:00 AM">09:00 AM</option>
                      <option value="09:15 AM">09:15 AM</option>
                      <option value="09:30 AM">09:30 AM</option>
                      <option value="09:45 AM">09:45 AM</option>
                      <option value="10:00 AM">10:00 AM</option>
                      <option value="10:15 AM">10:15 AM</option>
                      <option value="10:30 AM">10:30 AM</option>
                      <option value="10:45 AM">10:45 AM</option>
                      <option value="11:00 AM">11:00 AM</option>
                      <option value="11:15 AM">11:15 AM</option>
                      <option value="11:30 AM">11:30 AM</option>
                      <option value="11:45 AM">11:45 AM</option>
                      <option value="12:00 PM">12:00 PM</option>
                      <option value="12:15 PM">12:15 PM</option>
                      <option value="12:30 PM">12:30 PM</option>
                      <option value="12:45 PM">12:45 PM</option>
                      <option value="01:00 PM">01:00 PM</option>
                      <option value="01:15 PM">01:15 PM</option>
                      <option value="01:30 PM">01:30 PM</option>
                      <option value="01:45 PM">01:45 PM</option>
                      <option value="02:00 PM">02:00 PM</option>
                      <option value="02:15 PM">02:15 PM</option>
                      <option value="02:30 PM">02:30 PM</option>
                      <option value="02:45 PM">02:45 PM</option>
                      <option value="03:00 PM">03:00 PM</option>
                      <option value="03:15 PM">03:15 PM</option>
                      <option value="03:30 PM">03:30 PM</option>
                      <option value="03:45 PM">03:45 PM</option>
                      <option value="04:00 PM">04:00 PM</option>
                      <option value="04:15 PM">04:15 PM</option>
                      <option value="04:30 PM">04:30 PM</option>
                      <option value="04:45 PM">04:45 PM</option>
                      <option value="05:00 PM">05:00 PM</option>
                      <option value="05:15 PM">05:15 PM</option>
                      <option value="05:30 PM">05:30 PM</option>
                      <option value="05:45 PM">05:45 PM</option>
                      <option value="06:00 PM">06:00 PM</option>
                      <option value="06:15 PM">06:15 PM</option>
                      <option value="06:30 PM">06:30 PM</option>
                      <option value="06:45 PM">06:45 PM</option>
                      <option value="07:00 PM">07:00 PM</option>
                      <option value="07:15 PM">07:15 PM</option>
                      <option value="07:30 PM">07:30 PM</option>
                      <option value="07:45 PM">07:45 PM</option>
                      <option value="08:00 PM">08:00 PM</option>
                      <option value="08:15 PM">08:15 PM</option>
                      <option value="08:30 PM">08:30 PM</option>
                      <option value="08:45 PM">08:45 PM</option>
                      <option value="09:00 PM">09:00 PM</option>
                      <option value="09:15 PM">09:15 PM</option>
                      <option value="09:30 PM">09:30 PM</option>
                      <option value="09:45 PM">09:45 PM</option>
                      <option value="10:00 PM">10:00 PM</option>
                      <option value="10:15 PM">10:15 PM</option>
                      <option value="10:30 PM">10:30 PM</option>
                      <option value="10:45 PM">10:45 PM</option>
                      <option value="11:00 PM">11:00 PM</option>
                      <option value="11:15 PM">11:15 PM</option>
                      <option value="11:30 PM">11:30 PM</option>
                      <option value="11:45 PM">11:45 PM</option>
                    </select>
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Location <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <input class="span12" type="text" name="location" />
                  </div>
                </div>
                <div class="row-fluid">
                  <div class="span4">
                    <label>Map <i class="icon-info-sign" data-rel="popover" data-content="And here's some amazing content. It's very engaging. right?" title="A Title"></i></label>
                    <input class="span12" type="text" name="map" />
                  </div>
                </div>
                <div class="row-fluid">&nbsp;</div>
                <div class="row-fluid">
                  <div class="span12">                           
                    <input type="hidden" name="status" value="1" />
                    <button class="btn btn-primary" type="submit" name="saveChanges">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Copy Modal -->
        <div class="modal hide fade" id="copyModal">
          <form action="index.php?action=copyEvent" method="post" id="copyEvent" name="copyEvent">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">X</button>
              <h3>Copy Event</h3>
            </div>
            <div class="modal-body" id="copy_modal_body">
              <p>Select the dat that you wish to copy the event to... </p>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <button class="btn btn-primary" type="submit" name="saveChanges">Save Changes</button>
            </div>
          </form>
        </div>
      </div><!--/span-->
    </div><!--/row-->
