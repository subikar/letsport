<?php defined ('ITCS') or die ("Go away.");
$Start = IRequest::getInt('start',0);
//print_r($this->page); exit;
?>
<ul boundary-links="false" total-items="userAccounts.length-6" ng-model="currentPage" items-per-page="itemsPerPage" previous-text="‹" next-text="›" class="mb0 pagination-sm pagination ng-isolate-scope ng-pristine ng-valid">
                                <!-- ngIf: boundaryLinks -->
                                <!-- ngIf: directionLinks -->
                                <li class="ng-scope disabled" ng-if="directionLinks" ng-class="{disabled: noPrevious()}"><a class="ng-binding" href="" ng-click="selectPage(page - 1)"> < </a></li>
                                <!-- end ngIf: directionLinks -->
								<?php foreach($this->page as $key=>$value):?>
                                <!-- ngRepeat: page in pages track by $index -->
                                <li class="ng-scope <?php echo ($Start == ($key - 1))?'active':''?>"><a class="ng-binding" href="<?php echo $value; ?>"><?php echo $key; ?></a></li>
                                <?php endforeach; ?> 
                                <!-- ngIf: directionLinks -->
                                <li class="ng-scope" ng-if="directionLinks" ng-class="{disabled: noNext()}"><a class="ng-binding" href="" ng-click="selectPage(page + 1)"> > </a></li>
                                <!-- end ngIf: directionLinks -->
                                <!-- ngIf: boundaryLinks -->
                              </ul>