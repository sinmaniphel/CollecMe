Feature: list user collections
  In order to see all my collections
  As a logged in user
  I need to have a mechanism to list my collections

  Scenario: access collections page from navigation bar
    Given that I am logged in as user "admin" with password "admin"
    When I look at the navigation bar
    Then there should be a menu item to access my collections

  Scenario: no existing collection
    Given that I am logged in as user "admin" with password "admin"
    When I look at the navigation bar
    Then there should be a menu item to access my collections
    But said item should not have any sub item

  Scenario: list existing collections in the navigation bar
    Given that I am logged in as user "admin" with password "admin"
    Given I have a number of collections
    When I look at the navigation bar
    Then there should be an item for my collections
    And that menu item should redirect me to a page listing my collections
    And there should be a sub menu item for each collection
    And the sub menu item should redirect me to a corresponding collection
