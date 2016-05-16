// JavaScript Document

function mmLoadMenus() {
  if (window.mm_menu_0901060603_0) return;
        window.mm_menu_0901060603_0_1 = new Menu("Services",360,18,"Verdana, Arial, Helvetica, sans-serif",12,"#000000","#FFFFFF","#FFFFFF","#F79A30","left","middle",3,0,1000,-5,7,true,true,true,0,false,true);
    mm_menu_0901060603_0_1.addMenuItem("Full&nbsp;Service&nbsp;Movers","location='locator/fullservicemovers.php'");
    mm_menu_0901060603_0_1.addMenuItem("Loading/Unloading&nbsp;Help","location='loadingunloading/loadingunloading.php'");
    mm_menu_0901060603_0_1.addMenuItem("Trasportation&nbsp;Help&nbsp;","location='transportation/transportation.php?trans=1'");
    mm_menu_0901060603_0_1.addMenuItem("Storage&nbsp;Facilities","location='storage/storage.php?store=1'");
    mm_menu_0901060603_0_1.addMenuItem("Packing&nbsp;Supplies&nbsp;and&nbsp;Materials","location='packing/packing.php?packing=1'");
     mm_menu_0901060603_0_1.hideOnMouseOut=true;
     mm_menu_0901060603_0_1.bgColor='#999999';
     mm_menu_0901060603_0_1.menuBorder=1;
     mm_menu_0901060603_0_1.menuLiteBgColor='#FFFFFF';
     mm_menu_0901060603_0_1.menuBorderBgColor='#CCCCCC';
  window.mm_menu_0901060603_0 = new Menu("root",360,18,"Verdana, Arial, Helvetica, sans-serif",12,"#000000","#FFFFFF","#FFFFFF","#F79A30","left","middle",3,0,1000,-5,7,true,true,true,0,false,true);
  mm_menu_0901060603_0.addMenuItem("Frequently&nbsp;Asked&nbsp;Questions","location='faq1.php'");
  mm_menu_0901060603_0.addMenuItem("What&nbsp;is&nbsp;BBB,&nbsp;AMSA&nbsp;&&nbsp;Movingscam.com?","location='bbb.php'");
  mm_menu_0901060603_0.addMenuItem("Member's&nbsp;login&nbsp;","location='locator/mem.php'");
  mm_menu_0901060603_0.addMenuItem("Become&nbsp;a&nbsp;network&nbsp;member","location='mem2.php'");
  mm_menu_0901060603_0.addMenuItem(mm_menu_0901060603_0_1);
   mm_menu_0901060603_0.hideOnMouseOut=true;
   mm_menu_0901060603_0.childMenuIcon="./images/arrows.gif";
   mm_menu_0901060603_0.bgColor='#999999';
   mm_menu_0901060603_0.menuBorder=1;
   mm_menu_0901060603_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0901060603_0.menuBorderBgColor='#CCCCCC';

mm_menu_0901060603_0.writeMenus();
} // mmLoadMenus()