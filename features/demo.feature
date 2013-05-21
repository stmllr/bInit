# features/test.feature
Feature: Test
  In order to understand how bInit works
  As a bInit user
  I want to execute a feature demonstration

  @javascript
  Scenario: Search for bdd on wikipedia
    Given I am on "/"
    When I fill in the following:
      |searchInput|BDD|
    And I press "searchButton"
    Then I should see "Behavior-driven development"

