// @ts-check
const { test, expect } = require('@playwright/test');

test('Check if menu exists', async ({ page }) => {
	//Go to login page
	await page.goto('http://localhost:8889/wp-admin');
	//Insert credentials and login
	await page.getByLabel('Username or Email Address').fill('admin');
	await page.getByLabel('Password').fill('password');
	await page.getByRole('button', { name: 'Log In' }).click();
	//Search Ajax add to cart for WooCommerce menu
	await expect(
		page.locator('.wp-menu-name:has-text("Ajax add to cart for WooCommerce")')
	).toBeVisible();
});
