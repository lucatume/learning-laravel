<?php
$I   = new AcceptanceTester( $scenario );
$I->wantTo( 'check I can log in' );

$I->amOnPage( '/' );

$I->see( 'Dashboard' );
$I->see( 'Login' );

$I->click( 'Login' );

$I->waitForText( env( 'LOGIN_EMAIL' ) );
