# uploadhtml5
# Development Standard

-   [Development Process](#development-process)
    -   [Pre-Sprint Workflow](#pre-sprint-workflow)
        -   [UI Design](#ui-design)
        -   [Data Science](#data-science)
    -   [Sprint Workflow](#sprint-workflow)
        -   [Development](#development)
        -   [Hotfix Deployment](#hotfix-deployment)
    -   [Post-Sprint Workflow](#post-sprint-workflow)
        -   [Production Deployment](#production-deployment)
-   [Development Policies](#development-policies)
    -   [Issue Tracking](#issue-tracking)
    -   [Source Code Management](#source-code-management)
    -   [Documentation](#documentation)
    -   [Coding Styles](#coding-styles)
    -   [Logging](#logging)
    -   [Testing](#testing)
        -   [Unit Testing](#unit-testing)
        -   [Integration Testing](#integration-testing)
        -   [Acceptance Testing](#acceptance-testing)
    -   [Versioning](#versioning)
        -   [Client Versioning](#client-versioning)
        -   [Server Versioning](#server-versioning)
    -   [Public API](#public-api)
    -   [Deployment](#deployment)
-   [Technology Stacks](#technology-stacks)
    -   [Frontend](#frontend)
    -   [Backend](#backend)
    -   [Monolithic](#monolithic)
    -   [Databases](#databases)
    -   [Middlewares](#middlewares)
    -   [Infrastructure](#infrastructure)
-   [Environments](#environments)
    -   [Local Development Environment](#local-development-environment)
    -   [Server Continuous Integration Environment](#server-continuous-integration-environment)
    -   [Client Continuous Integration Environment](#client-continuous-integration-environment)
    -   [Server Integration Testing Environment](#server-integration-testing-environment)
    -   [Client Integration Testing Environment](#client-integration-testing-environment)
    -   [Server Staging Environment](#server-staging-environment)
    -   [Client Staging Environment](#client-staging-environment)
    -   [Server Production Environment](#server-production-environment)
    -   [Client Production Environment](#client-production-environment)
-   [DevOps Policies](#devops-policies)
    -   [Twelve-Factors](#twelve-factors)
    -   [OS-Level Virtualization](#os-level-virtualization)
    -   [Infrastructure as Code](#infrastructure-as-code)
    -   [Immutable Infrastructure](#immutable-infrastructure)
    -   [Blue-Green Deployment](#blue-green-deployment)
    -   [Resilience and Elasticity](#resilience-and-elasticity)
-   [AWS Policies](#aws-policies)
    -   [Account](#account)
    -   [Environment](#environment)
    -   [VPC](#vpc)
    -   [Subnet](#subnet)
    -   [Security Group](#security-group)
    -   [Role](#role)
    -   [Gateway](#gateway)
    -   [Resource Name](#resource-name)
    -   [Host Name](#host-name)
    -   [Security](#security)

## Development Process

-   The process is based on [Scrum](https://www.scrum.org/Resources/What-is-Scrum)

### Pre-Sprint Workflow

1.  Product owner defines and prioritizes product backlogs as epics on Pivotal Tracker
    1.  Epics should be declared in the granularity of minimal business value unit
    1.  Epics should focus on business level requirements and avoid mentioning UI
        or technical matters -   if needed, they should be declared as constraints
    1.  Epic descriptions should be declared in [Gherkin](https://github.com/cucumber/cucumber/wiki/Gherkin)
    1.  Epic descriptions should include the followings in the narrative section:
        1.  User Story: As a {role} / I want to {goal} / In order to {benefit}
        1.  Context: business level background and reasoning
        1.  Rules: business rules should be implemented
        1.  Constraints: non-business level matters should be considered in the development
            (e.g. platform support, infrastructure, integration, etc. specific to
            the feature)
1.  If UI design work required, UI designer creates UI design and prototype based
    on the product backlogs (cf. [UI design workflow](#ui-design))
1.  If data-scientific work required, data scientist builds data-scientific model
    with specification document and executable prototype based on the product backlogs
    (cf. [data science workflow](#data-science))
1.  [Three Amigos](https://www.scrumalliance.org/community/articles/2013/2013-april/introducing-the-three-amigos):
    product owner and scrum master discuss weekly 30min or bi-weekly 60min for each:
    1.  With UI designer, on how to deliver the product backlogs with the UI design
    1.  With data scientist, on how to deliver the product backlogs with the data-scientific
        model

Notes:

-   Should be finished before assigning product backlogs to sprint

Tools:

-   [Pivotal Tracker](https://www.pivotaltracker.com/)

#### UI Design

1.  Product owner defines requirements as Gherkin features
1.  UI designer creates wireframes based on the requirements
1.  UI designer creates low fidelity prototype based on the wireframes
1.  Product owner reviews the prototype
    1.  Prototype design accepted ⇒ go to step 7
    1.  Prototype design rejected ⇒ go to step 5
1.  UI designer fixes the wireframes and/or the prototype based on product owner's
    feedback
1.  Go to step 4
1.  UI designer creates high fidelity graphical design based on the wireframes
1.  UI designer creates high fidelity prototype based on the graphical design
1.  Product owner reviews the prototype
    1.  Prototype design accepted ⇒ go to step 12
    1.  Prototype design rejected ⇒ go to step 10
1.  UI designer fixes the graphical design and/or the prototype based on product
    owner's feedback
1.  Go to step 9
1.  UI designer passes the graphical design and the prototype to engineers for development

Notes:

-   UI should be designed as themed components based on [Google Material Design](https://material.google.com/)
-   Existing component library design should be reused as much as possible
-   High fidelity prototype should be created as UI specification
-   The following screens should be supported responsively
    -   Resolutions: width 320+ pt, height 568+ pt
    -   Breakpoints: 320, 768, 1366 pt
    -   Sizes: mobile 4 ~ 12.9 in, desktop 12+ in
    -   Aspect Ratios: portrait 3:4 ~ 9:16, landscape 16:9 ~ 4:3
    -   Orientations: mobile portrait and landscape, desktop landscape
-   Prototype should focus on information, graphical and interaction design, not
    constraining implementation
-   Prototype should be delivered weekly according to the product backlog priority

Tools:

-   [Sketch](https://www.sketchapp.com/)
-   [Principle](http://principleformac.com/)

#### Data Science

1.  Product owner defines a requirement with a data set based on the production data
    schema
1.  Data scientist designs a model (algorithms and parameters) satisfying the requirement
    with the data set
1.  Data scientist implements a model prototype, which can execute the model validation
    against arbitrary production data subset by any engineers granted access to the
    production data
1.  Data scientist validates the model against the requirement using the prototype
    and statistically sufficient production data subset
1.  Product owner specifies search queries over production data to evaluate the model
1.  Data scientist evaluates the model based on the queries and the corresponding
    production data subset using the prototype:
    1.  If the prototype does not have production data full set, load production
        data subset necessary to execute the queries into the prototype
    1.  Execute the queries on the prototype over the loaded data set
    1.  Pass results of the queries to product owner
1.  Product owner reviews the results and identify problems
    1.  Problems are unacceptable level ⇒ go to step 7
    1.  Problems are acceptable level ⇒ go to step 10
1.  Product owner passes the problems to data scientist
1.  Data scientist improves the model to solve the problems
1.  Go to step 4
1.  Data scientist finalizes documentation of the model specification and prototype
1.  Data scientist passes the model specification and prototype to engineers for
    deployment

Notes:

-   Model should support incremental data update
-   Specification document should describe overall idea, data structures, algorithms,
    parameters, and validation method/criteria of the model
-   Model should be able to be validated continuously using the prototype
    -   I.e. steps 5.1-3 should be able to execute in minutes or less per query
-   Prototype should focus on model validation, not constraining production deployment
-   Validated model specification and prototype should be delivered weekly according
    to the product backlog priority

### Sprint Workflow

1.  Product Backlog Refinement Part 0 - product backlog (epics) learning and clarification
    of questions (only by developers): 60min
1.  Product Backlog Refinement Part 1 - product backlog explanation and answers to
    the questions: 60min
1.  Product Backlog Refinement Part 2 - sprint backlog creation (epic-to-stories/tasks
    breakdown) and story point estimation (number of tasks = story points in general)
    (only by developers): 60min
1.  Sprint Planning Part 1 - sprint backlog prioritization and sprint goal confirmation:
    60min
1.  Sprint Planning Part 2 - sprint backlog confirmation on "how to deliver" and
    member assignment (only by developers): 60min
1.  Daily Scrum - status and impediments reporting and confirmation (only by developers):
    15min
1.  Sprint Review - delivered stories demo and production release decision: 60min
1.  Sprint Retrospective - discussion on agility improvement with keep/problem/try
    (only by developers): 45min
1.  Sprint Reporting - sprint report declaration for product owner: 15min

Notes:

-   Sprint duration should be 1 week
-   All scrum events should be strictly time-boxed
-   If doing all except daily scrum in one time, do in order of 7 ⇒ 4 ⇒ 2 ⇒ 5 ⇒ 8
    ⇒ 9 (the "review" day) / 2 ⇒ 1 (next day of the "review" day)

Tools:

-   [Pivotal Tracker](https://www.pivotaltracker.com/)

#### Development

1.  Create a branch corresponds to the story from master on GitHub
    1.  Name as `{story ID}-{hyphen-delimited lowercase story title without punctuations}`
1.  Create an empty commit on the branch
    1.  Put `[start] [skip ci] {story title} {story URL}` at the first line of the
        commit comment (this starts the story on Pivotal Tracker)
1.  Push the commit
1.  Create a pull request on the branch to the master on GitHub
    1.  Title the same as the story title
    1.  Add `wip` and `spec` labels
    1.  Add a link to the story on Pivotal Tracker to the description
1.  Add an activity comment with a link to the pull request to the story on Pivotal
    Tracker
1.  Work on the branch for the story with local commits until ready for specification
    review
    1.  If API provider is included, define specification on Apiary, and add a link
        to the specification to the pull request description on GitHub
    1.  Define unit-level specifications (`describe`/`it`) as unit test skeletons
    1.  Prepare application code skeletons based on the specifications
    1.  Implement unit tests based on the skeletons
    1.  Implement integration tests by reusing unit tests as necessary
    1.  Implement acceptance test based on the feature and the application code skeletons
1.  Catch the branch up to the upstream if behind
    1.  Rebase the branch onto the upstream if not in changes requested in review
    1.  Pull and merge the upstream if in changes requested in review
1.  Rebase the branch onto the upstream master if behind
    1.  Rebase the branch onto master if not in changes requested in review
    1.  Merge master to the branch if in changes requested in review
1.  Squash all local commits into one using interactive rebase
    1.  Put `[skip ci] {story title} {story URL}` at the first line of the commit
        comment
1.  Push the commit
1.  Remove `wip` label from the pull request
1.  Get 2 review approvals for the pull request
    1.  If changes requested, add `wip` label to the pull request, and go back to
        step 6
1.  Remove `spec` label from and add `wip` and `impl` labels to the pull request
1.  Work on the branch for the story with local commits until ready for implementation
    review
    1.  Implement application codes based on the skeletons to pass all the tests
1.  Catch the branch up to the upstream if behind
    1.  Rebase the branch onto the upstream if not in changes requested in review
    1.  Pull and merge the upstream if in changes requested in review
1.  Rebase the branch onto the upstream master if behind
    1.  Rebase the branch onto master if not in changes requested in review
    1.  Merge master to the branch if in changes requested in review
1.  Squash all local commits into one using interactive rebase
    1.  Put `[finish] {story title} {story URL}` at the first line of the commit
        comment (this finishes the story on Pivotal Tracker)
1.  Push the commit
1.  Confirm CI and automated code review passed on the pull request - if failed,
    put the story status back to `Started` on Pivotal Tracker and go back to step
    14
1.  Remove `wip` label from the pull request
1.  Get 2 review approvals for the pull request
    1.  If changes requested, put the story status back to `Started` on Pivotal Tracker,
        add `wip` label to the pull request, and go back to step 14
1.  Remove `impl` label from the pull request
1.  Check previous master CI build passed
1.  Check there is no story waiting for acceptance
1.  Merge the pull request in "Squash and merge" mode on GitHub
    1.  Put `{story URL} [deliver #{story ID}]` at the first line of the merge commit
        comment description (this finishes the story on Pivotal Tracker)
    1.  This should deploy master to staging automatically
        1.  Adding `[skip cd]` to the merge comment should skip staging deployment
        1.  Adding `[dist app]` to the merge comment should distribute mobile application
            to iTunes Connect Internal / Google Play Alpha Testing
1.  Check master CI build and the story acceptance criteria on staging - if the master
    CI build failed or the story acceptance criteria is not satisfied:
    1.  Revert the pull request on GitHub
    1.  Reject the story and with adding activity comment of the rejection reason
        on Pivotal Tracker
    1.  Create new pull request from the reverted pull request with adding `wip`
        and `impl` labels on GitHub
    1.  Add an activity comment with a link to the new pull request to the story
        on Pivotal Tracker
    1.  Go back to step 14
1.  Accept the story on Pivotal Tracker
1.  Delete the branch on GitHub

Notes:

-   The workflow should be executed per story
-   Pull request should not be merged if
    -   Master CI build failing; if failing, it should be fixed in the previously merged
        story broke the master build before merge
    -   There is a story waiting for acceptance; wait until the story accepted, or
        rejected and the PR reverted
-   On modifying existing codebase, work steps for specification review (6.1-6) are
    combined with modifications on existing API specifications, tests, and skeleton
    level application codes
-   On working on a story which does not require or only requires specification,
    steps 6-12 should be skipped, and `spec` and `impl` tags may not be used

Tools:

-   [Pivotal Tracker](https://www.pivotaltracker.com/)
-   [GitHub](https://github.com/)
-   [Apiary](https://apiary.io/)
-   [CircleCI](https://circleci.com/)
-   [Code Climate](https://codeclimate.com/)
-   [Sauce Labs](https://saucelabs.com/)
-   [Flood](https://flood.io/)
-   [New Relic](https://newrelic.com/)

#### Hotfix Deployment

**Note:** Hotfix deployment at late sprint should be avoided as much as possible,
because it would require many pull request reverts, which are for removing already
merged but not approved for production deployment, to only apply hotfix on the revision
currently deployed to production.

If hotfix deployment to production is required after master merge which is still
not approved to deploy to production, its deployment process should be as the followings:

1.  Create branch and pull request off from the revision currently deployed to production
    for hotfix (A = deployed to production, B, C = still not approved for production
    deployment, D = hotfix)
    ```
    master: ··· - A - B - C
                   \
    hotfix:         D
    ```
1.  Revert non-approved pull request on master (F = revert of C, G = revert of B)
    ```
    master: ··· - A - B - C - F - G
                   \
    hotfix:         D
    ```
1.  Rebase hotfix branch onto master
    ```
    master: ··· - A - B - C - F - G
                                   \
    hotfix:                         D'
    ```
1.  Merge hotfix pull request to master
    ```
    master: ··· - A - B - C - F - G - D'
    ```
1.  Get approval for production deployment on staging and deploy to production
1.  Create advance branch and pull request from the revision previously deployed
    to production, and cherry-pick commit(s) reverted on master onto the branch (B',
    C' = cherry-pick of B, C)
    ```
    advance:        B' - C'
                   /
    master: ··· - A - B - C - F - G - D'
    ```
1.  Rebase advance branch onto master
    ```
    advance:                            B" - C"
                                       /
    master: ··· - A - B - C - F - G - D'
    ```
1.  Merge advance pull request to master (J = squash of B", C")
    ```
    master: ··· - A - B - C - F - G - D' - J
    ```
1.  Check on staging

-   Hotfix story title should be prefixed by `Hotfix`, and branch and pull request should
    be named or titled as usual based on the story title: e.g. `Hotfix customer support
    phone number`, `1234567890-hotfix-customer-support-phone-number`
-   Advance branch and pull request should be named or titled as using `Advance`
    to replace `Hotfix`: e.g. `Advance customer support phone number`, `1234567890-advance-customer-support-phone-number`

### Post-Sprint Workflow

#### Production Deployment

1.  Create a release story on Pivotal Tracker
    -   This should be put at the highest position of undone stories in current iteration
1.  Confirm production deployment scope and schedule to the PO, and declare them
    to the description in the release story
1.  Describe all the steps to be executed, including rollback and its criteria to
    the description in the release story
    -   CLI: commands to be executed in complete form including arguments
    -   Web console: screen URL, form field name, current and new value to set
    -   Use of web console is prohibited for any AWS create/update/delete operations,
        CLI must be used instead
1.  Get review for the steps from the team
1.  Wait until the scheduled time the PO specified
1.  Get final confirmation and approval for production deployment execution from
    the PO
1.  Record screen and voice
1.  Start terminal and execute the following:
    ```
    export PS1="$(date +%Y-%m-%dT%H:%M:%S%z) \u@\h:\w\$ "
    script
    env
    ```
1.  Execute the steps one by one with verbal confirmation to/from the reviewer
    -   If the step targets to AWS, check the result on CloudWatch logs and keep
        their URLs for reporting
    -   If anything wrong, notify the failure to the team and the PO and rollback
        immediately
1.  On successful production deployment completion, notify it to the PO
1.  Report screen recording, `script` log, and CloudWatch log URLs to the activities
    in the release story
1.  Create and merge a PR to bump the patch version for future release
    -  The link to the PR should be logged to the activities in the release story
    -  The SM should review and approve the PR based on the [versioning](#versioning)
       policy
    -  Put `[skip ci]` in merge commit message
1.  Finish the release story on Pivotal Tracker

Notes:

-   Any PR merges must be suppressed from the workflow initiated until completed
-   Only master HEAD revision should be deployed to production

## Development Policies

### Issue Tracking

-   Project should be created based on team, not product or service
-   Project should be newly created when the team is reassigned to the other product
-   Product owner should only use epics to define and prioritize product backlogs
-   Product owner should not create or modify stories except adding activities
-   Developers should use features to to define and estimate sprint backlogs, which
    are usually broken down into several from a product backlog and labeled to it
-   Developers should not create or modify epics except putting activities
-   Features/bugs should be created per repository
-   Features/bugs should be created as minimal user delivery unit
-   Features/bugs should have acceptance criteria and solution architecture in the
    description
-   Features/bugs should have tasks as milestones for each half day
-   Features should have points equal to number of its tasks; i.e. 1 point should
    correspond to a half day effort
-   Bugs should be used for defects relating already accepted feature or no specific
    features related - defects relating unaccepted feature should be handled in tasks
    and/or activities in the feature
-   Chores should be used for works which delivers nothing or regular/periodic maintenance/housekeeping
    works irrelevant to any specific epic or feature - non-routine works should be
    relevant to some feature or epic, and then the work should be a task under the
    feature or a feature under the epic
-   Story dependencies should always be handled as declared in [Handling dependencies](https://www.pivotaltracker.com/help/articles/handling_dependencies/)
-   Developers should add status report as activity of started but unaccepted story
    at daily scrum unless it is clear by tasks
-   Developers should not work on multiple stories at once: if a story is need to
    be suspended for some reason, add activity with the reason and resume condition,
    put the status to unstarted, and start next story - when the resume condition
    satisfied, put the status to started and resume the work on the story
-   Story status should be synchronized with delivery status as follows:

    Story Status | Delivery Status
    ------------ | -------------------------------
    Started      | Pull Request Created
    Finished     | Ready for Implementation Review
    Delivered    | Delivered to Staging
    Accepted     | Staging Confirmed by Developers

### Source Code Management

-   [GitHub Flow](https://guides.github.com/introduction/flow/) should be used
-   Rebase should always be used unless changes requested in review
-   Branching should always be from master, and non-master branch rebasing/merging
    should always be on/to master - branching from non-master branch and rebasing/merging
    non-master branch on/to another non-master branch are prohibited
-   Local Git should be configured with:
    -   `git config --global user.email {your work email}`
    -   `git config --global user.name "{your full name in English} ({your GitHub
        username})"`
    -   `git config --global branch.autosetuprebase always`
-   Local repository clones should be configured with:
    -   `git tracker init` ([git-tracker](https://github.com/stevenharman/git_tracker))
-   GitHub repositories should be configured as follows:
    -   Settings > Options > Merge button: check only "Allow squash merging"
    -   Settings > Branches
        -   Default branch: master
        -   Protected branches > Choose a branch... > master
            -   master > Edit > Branch protection for master
                -   Check "Protect branch"
                -   Check "Require pull request reviews before merging"
                -   Check "Require status checks to pass before merging"
                    -   Check "ci/circleci", "codeclimate", "codeclimate/coverage"
                -   Check "Require branches to be up to date before merging"

### Documentation

-   Repository should have README.md in the top directory with the following contents
    -   Purpose
    -   Usage
    -   Architecture
    -   Repository Layout
    -   Build
    -   Run
    -   Test
    -   Deploy
-   Source documentation should be preferred against standalone
-   The following tools should be used for source documentation:
    -   JavaScript: [documentation.js](http://documentation.js.org)
    -   Python: [Sphinx](http://www.sphinx-doc.org/) / [recommonmark](http://recommonmark.readthedocs.io/)
    -   Bash: N/A
    -   Scala: [Scaladoc](http://docs.scala-lang.org/style/scaladoc.html) / [Paradox](http://developer.lightbend.com/docs/paradox/latest/)
    -   Ruby: [RDoc](https://rdoc.github.io/rdoc/)
-   Repository may have README.md in arbitrary directory for standalone documentation
    specific to the directory and descendants
-   Source and standalone documentation in repository should be reviewed in pull
    requests, with respect to quality and coverage
-   If documentation requires agreement/commitment, the documentation should be committed
    in repository and pull request review should be used for agreement/commitment
-   Standalone documentation other than README.md in repository directory or not
    requiring agreement/commitment should be written in the repository wiki
-   If documentation target spans to multiple repository, a product-wide repository
    should be created to host such documentation
-   Binary formats such as Excel/PowerPoint/Word should not be used for textual documentation,
    because of difficulty in revision control and collaborative editing

### Coding Styles

-   Should be checked during development and on CI using the followings:
    -   JavaScript: [Airbnb JavaScript Style Guide](https://github.com/airbnb/javascript)
        via [ESLint](http://eslint.org/)
    -   Python: [pycodestyle](https://pypi.python.org/pypi/pycodestyle) ([PEP8](https://www.python.org/dev/peps/pep-0008/))
    -   Bash: [ShellCheck](https://www.shellcheck.net/)
    -   Scala: [Scalastyle](http://www.scalastyle.org)
    -   Ruby: [RuboCop](http://rubocop.readthedocs.io/en/latest/)
    -   Markdown: [MDL](https://github.com/mivok/markdownlint)
-   Should be no errors or warnings - exclusions should be checked explicitly to
    be reduced as much as possible in code reviews

### Logging

-   Applications should log its activities with the following levels and criteria:
    -   `error`: Unexpected conditions, causing processing abortion
    -   `warn`: Unexpected conditions, not causing processing abortion but should
        be investigated
    -   `info`: Important processing events for operators
    -   `debug`: Processing events for developers
-   The following frameworks should be used for logging:
    -   JavaScript: [feathers-logger](https://github.com/feathersjs/feathers-logger)
        / [Winston](https://github.com/winstonjs/winston)
    -   Python: [logging](https://docs.python.org/3.6/library/logging.html)
    -   Bash: logger (cf. `man 1 logger`)
    -   Scala: [scala-logging](https://github.com/typesafehub/scala-logging)
    -   Ruby: [ActiveSupport::Logger](http://api.rubyonrails.org/classes/ActiveSupport/Logger.html)

### Testing

-   When fixing a bug (no feature change), a test case explicitly checking the fix
    should be added to unit or integration level

#### Unit Testing

-   Unit tests should be created per file
-   All objects/functions not defined in unit test target file should be mocked,
    except exported constant values defined in other file
-   All external resources except databases should be mocked
    - Mocking database is preferred, but may not be mocked if difficult
-   All mocks should be easily replaceable to the real one (e.g. using dependency
    injection), so that it can be reused for integration and acceptance tests
-   Coverage should be 100% - uncovered and ignores should be checked explicitly
    to be reduced as much as possible in code reviews
-   The following frameworks should be used:
    -   JavaScript: [Mocha](http://mochajs.org/) / [Chai](http://chaijs.com/) / [Sinon](http://sinonjs.org/)
        / [Enzyme](http://airbnb.io/enzyme/)
    -   Python: [doctest](https://docs.python.org/3/library/doctest.html) / [unittest](https://docs.python.org/3/library/unittest.html)
        / [unittest.mock](https://docs.python.org/3/library/unittest.mock.html) /
        [pytest](http://pytest.org/)
    -   Bash: [Bats](https://github.com/sstephenson/bats)
    -   Scala: [ScalaTest](http://www.scalatest.org/) / [Mockito](http://mockito.org/)
        / [ScalaCheck](https://www.scalacheck.org)
    -   Ruby: [Rspec](http://rspec.info/)

#### Integration Testing

-   Should cover all external resources
-   Should reuse unit tests by replacing mocks with real external resources

#### Acceptance Testing

-   Should cover all the scenario steps in the feature
-   Should reuse unit tests to drive UI components, and integration tests to achieve
    end-to-end
-   The following frameworks should be used:
    -   JavaScript: [Cucumber](https://cucumber.io/) / [Chimp](https://chimp.readme.io/)
    -   Python: [pytest-bdd](https://github.com/pytest-dev/pytest-bdd)
    -   Bash: N/A
    -   Scala: [ScalaTest](http://www.scalatest.org/) FeatureSpec
    -   Ruby: [Turnip](https://github.com/jnicklas/turnip) / [Capybara](http://teamcapybara.github.io/capybara/)

### Versioning

-   Packaging configuration should include version information based on [Semantic
    Versioning](http://semver.org/)
-   GitHub Release should be created automatically based on packaging configuration,
    at every production deployment or repository publishing, including pre-releases
    (release tag names should be preceded by `v`, e.g. `v1.0.0`)
-   For hybrid mobile applications, the iOS and Android builds from the same Git
    commit revision should have the same iTunes Connect IPA Version Number / Build
    Number and Google Play APK Version Name / Version Code, respectively
-   Code-push release should target all binary versions (wildcard)
-   App should always keep backward compatibility with one previous version at least

#### Client Versioning

Major:

-   Should be bumped in the pull request containing least-dependent server REST/WS
    API version change
-   Should override minor/patch version bump by setting them to `0`
-   Should be kept until production release once bumped

Minor:

-   Should be bumped in the pull request containing least-dependent server REST/WS
    API version change
-   Should override patch version bump by setting it to `0`
-   Should be kept until production release once bumped unless major version bump

Patch:

-   Should be bumped immediately after production release
-   Should be kept until production release once bumped unless major/minor version
    bump

#### Server Versioning

Major:

-   Should be bumped in the pull request containing REST/WS API change
-   Should override minor/patch version bump by setting them to `0`
-   Should be kept until production release once bumped
-   Previous major version API support should be kept
    -   The support removal should be done at the next major version bump at the
        earliest

Minor:

-   Should be bumped in the pull request containing REST/WS API change
-   Should override patch version bump by setting it to `0`
-   Should be kept until production release once bumped unless major version bump

Patch:

-   Should be bumped immediately after production release
-   Should be kept until production release unless major/minor version bump

### Public API

-   Public API should be provided in REST architecture, HTTPS protocol, and JSON
    data format
-   Public API should provide basic CRUD operations on data and basic business logics
    in pull semantics
-   If data integration is required, the following public APIs should be provided:
    -   Bulk data transfer API (pull) for obtaining initial data
    -   Data update event API (push) for keeping data up-to-date
-   Data integration should be one-way
-   Push API should notify events per transaction
-   Push API should provide asynchronous realtime messaging
-   Push API should provide at-least-once and ordered messaging QoS
-   Push API should provide publish-subscribe messaging pattern
-   Direct data access from external without API should not be provided
-   Public API should be documented in [API Blueprint](https://apiblueprint.org/)
-   Public API should be tested with [Dredd](http://dredd.readthedocs.io/)
-   Public API should be versioned at breaking change and have explicit support lifecycle
    for each version
-   Public API versions should be supported at least 2 years unless agreed with all
    consumers

### Deployment

-   Deployment to staging and production environment should use only master branch
-   Database schema should have own versions with migration scripts for each schema
    change, both version up and down
-   On changing database schema, both previous and new application versions should
    be supported

## Technology Stacks

-   Should not use alternative stack to this list
-   Should be explicitly agreed with all the stakeholders on adding/removing/replacing
    stack in this list
-   New stack of 2 weeks or more learning/adoption cost should be discussed to add
    to this list
-   At least 2 developers each in all teams should be capable for each stack in this
    list, except marked as "[\*]", which is not in all teams but only in the team
    using it

### Frontend

-   [React](https://facebook.github.io/react/)
-   [Material-UI](http://material-ui.com/)
-   [Styled Components](https://www.styled-components.com/)
-   [Redux](http://redux.js.org/)
-   [Feathers](http://feathersjs.com/) (client modules, server-side rendering)
-   [Babel](https://babeljs.io/)
-   [Flow](https://flowtype.org/)
-   [Webpack](http://webpack.github.io/)
-   [Yarn](https://yarnpkg.com/en/)
-   [PhoneGap](http://phonegap.com/)
-   [Fastlane](https://fastlane.tools/)
-   [Electron](http://electron.atom.io/)

Notes:

-   Single page responsive web and hybrid application
    -   Should implement only UI logics, not include any business logic
    -   Should consume backend services via REST API to execute business logics
-   Single codebase for all of the following client platforms:
    -   Web
        -   IE 11 / Windows 7, 8.1
        -   Edge latest / Windows latest
        -   Chrome latest / Windows latest
        -   Safari latest / macOS latest
        -   Chrome latest / macOS latest
        -   Mobile Chrome latest / Android 5.0+
        -   Mobile Safari latest / iOS latest
        -   Mobile Chrome latest / iOS latest
    -   Hybrid
        -   PhoneGap latest / Android 5.0+
        -   PhoneGap latest / iOS latest
        -   Electron latest / Windows 7+
        -   Electron latest / macOS latest

### Backend

#### JavaScript

-   [Feathers](http://feathersjs.com/) (REST API provider)
-   [Serverless](https://serverless.com/) (AWS Lambda Node.js)
-   [Babel](https://babeljs.io/)
-   [Flow](https://flowtype.org/)
-   [Yarn](https://yarnpkg.com/en/)

#### Scala

-   [\*] [Lagom](http://www.lagomframework.com/)

#### Ruby

-   [\*] [Rails](http://rubyonrails.org/) (API-only mode)

Notes:

-   Reactive microservice
    -   Should provide REST API or subscribe message broker queue/topic to serve
        business logics
    -   Should implement only business logics, not include any UI logic
-   Should use one of the above three sets of stacks in the following criteria
    -   Feathers: for implementing MVP ~ 1M DAU service backend
    -   Lagom: for high performance demand, e.g. 1M+ DAU service backend, distributed/realtime
        big data processing, etc.
    -   Rails: only for direct legacy RDB integration wrapper, and only when server-side
        JavaScript engineers unavailable

### Monolithic

-   [\*] [Vue](https://vuejs.org/)
-   [\*] [Vuetify](https://vuetifyjs.com/)
-   [\*] [Stylus](http://stylus-lang.com/)
-   [\*] [Pug](https://pugjs.org/)
-   [\*] [Vuex](https://vuex.vuejs.org/en/)
-   [\*] [Rails](http://rubyonrails.org/)

Notes:

-   This set of stacks should be used only for web browser client only MVP, and only
    when server-side JavaScript engineers unavailable

### Databases

-   [MongoDB](https://www.mongodb.com/) (document)
-   [Redis](http://redis.io/) (key-value)
-   [Aurora](https://aws.amazon.com/rds/aurora/) (relational)
-   [\*] [Neo4j](https://neo4j.com/) (graph)
-   [\*] [Elasticsearch](https://www.elastic.co/) (search engine)
-   [\*] [Cassandra](https://cassandra.apache.org/) (wide columns)
-   [\*] [InfluxDB](https://influxdata.com/) (time series)

### Middlewares

-   [\*] [Kafka](https://kafka.apache.org/) (messaging)
-   [\*] [Spark](https://spark.apache.org/) (batch processing)
-   [\*] [Flink](https://flink.apache.org/) (streaming)

### Infrastructure

-   [AWS](https://aws.amazon.com/)
-   [Docker](https://www.docker.com/)
-   [Ansible](https://www.ansible.com/)
-   [Boto3](https://aws.amazon.com/sdk-for-python/)
-   [Troposphere](https://github.com/cloudtools/troposphere) / [AWACS](https://github.com/cloudtools/awacs)

## Environments

Applications should have the following environments.

### Local Development Environment

-   Platform: macOS latest
-   Server/Database/Middleware: run as Docker image identical to the other environments
    -   Corresponding latest server/database/middleware official image should be
        used whenever available
    -   `latest`, `curl` or `scm` tag in buildpack-deps should be used for the base
        whenever building image from scratch
-   Data: test data, prepared by the developers
    -   Irreversible migration should never be used, except deleting obsolete data
        in several revisions after successful production deployment with backup
-   External System: stubbed/mocked, no actual connection
-   Deployment: automatically-triggered by code modification

### Server Continuous Integration Environment

-   Platform: CircleCI Ubuntu latest VM + Apiary
-   Server/Database/Middleware: run as Docker image identical to the other environments
    (run all the necessary Docker images in the VM)
-   Data: test data, prepared by the developers
-   External System: stubbed/mocked, no actual connection
-   Deployment: automatically-triggered by pushes to open pull request, automatic
    staging deployment on every successful master merge of pull request

### Client Continuous Integration Environment

-   Platform
    -   Web: CircleCI macOS latest VM + Sauce Labs
    -   Android: CircleCI macOS latest VM + Sauce Labs
    -   iOS: CircleCI macOS latest VM + Sauce Labs
    -   Windows: AppVeyor Windows latest VM
    -   macOS: CircleCI macOS latest VM
-   Server
    -   Run as Docker image identical to the other environments (run all the necessary
        Docker images in the VM)
-   Data: test data, prepared by the developers
-   External System: stubbed/mocked, no actual connection
-   Deployment: automatically-triggered by pushes to open pull request, automatic
    staging deployment on every successful master merge of pull request

### Server Integration Testing Environment

-   Platform: AWS ECS with the latest Amazon ECS-optimized AMI
-   Data: production data, refreshed daily with drop & import from production database
    (migrate after import as necessary)
-   External System: actual connection to test environment
-   Infrastructure: the smallest configuration for production data and external system
    integration
-   Deployment: manually-triggered, specifying a pull request branch for integration
    testing (deployment of non pull request branch should be avoided)

### Client Integration Testing Environment

-   Platform: real device installation through
    -   Web: access to the integration testing web server
    -   Android/iOS: CodePush Integration Deployment (no corresponding iTunes Connect
        / Google Play Testing, must be installed on local machine if updated native
        part)
    -   Windows/macOS: Electron Auto-Updater Alpha Channel
-   Server: actual connection to the integration testing server
-   External System: actual connection to test environment
-   Deployment: manually-triggered, specifying a pull request branch for integration
    testing (deployment of non pull request branch should be avoided)

### Server Staging Environment

-   Platform: AWS ECS with the latest Amazon ECS-optimized AMI
-   Data: production data, refreshed daily with drop & import from production database
    (migrate after import as necessary)
-   External System: actual connection to staging environment, or production environment
    if staging unavailable
-   Infrastructure: identical configuration to the production environment, except
    instance and cluster size are the smallest
-   Deployment: automatically-triggered by CI, on every successful master merge of
    pull request

### Client Staging Environment

-   Platform: real device installation through
    -   Web: access to the staging web server
    -   Android: CodePush Staging Deployment, or Google Play Alpha Testing if native
        part updated
    -   iOS: CodePush Staging Deployment, or iTunes Connect Internal Testing if native
        part updated
    -   Windows/macOS: Electron Auto-Updater Beta Channel
-   Server: actual connection to the staging server
-   External System: actual connection to staging environment, or production environment
    if staging unavailable
-   Deployment: automatically-triggered by CI, on every successful master merge of
    pull request

### Server Production Environment

-   Platform: AWS ECS with the latest Amazon ECS-optimized AMI
-   Data: production data
-   External System: actual connection to production environment
-   Infrastructure: identical configuration to the staging environment, except instance
    and cluster size are for the production QoS requirements
-   Deployment: manually-triggered, upon approval by the product owner

### Client Production Environment

-   Platform: real device installation through
    -   Web: access to the production web server
    -   Android: CodePush Production Deployment, or Google Play Store if native part
        updated
    -   iOS: CodePush Production Deployment, or iTunes Connect Store if native part
        updated
    -   Windows/macOS: Electron Auto-Updater Release Channel
-   Server: actual connection to the production server
-   External System: actual connection to production environment
-   Deployment: manually-triggered, upon approval by the product owner

## DevOps Policies

### Twelve-Factors

-   Infrastructure components should comply with [The Twelve-Factor App](http://12factor.net/)
    methodology

### OS-Level Virtualization

-   Server applications and self-managed backing resources should be provisioned
    as images, which should be able to be run on all environments including developer's
    local environment without modifications

### Infrastructure as Code

-   Infrastructure components should be defined as code and able to be created automatically
    from scratch by the code

### Immutable Infrastructure

-   Infrastructure components should be immutable and updated by deleting and recreating
    the components by the infrastructure code

### Blue-Green Deployment

-   Server applications and self-managed backing resources should be deployed with
    [Blue-Green Deployment](http://martinfowler.com/bliki/BlueGreenDeployment.html)

### Resilience and Elasticity

-   Infrastructure components should support resilience and elasticity automatically
    in some agreed service level

## AWS Policies

### Account

-   1 AWS account per product (= business unit)

### Environment

-   4 environments per product: production, staging, integration, development

### VPC

-   1 VPC per product environment (4 VPCs per product)
-   VPC peering in hub & spoke topology: production hub ⇔ production spokes, staging
    hub ⇔ staging and integration spokes (no integration and development hub)
-   Network address: hub 10.2.0.0/16 (production) and 10.12.0.0/16 (staging), spoke
    10.N.0.0/16, where N assigned per product [128…131], [132…135], …, [252…255],
    production N % 4 = 0, staging N % 4 = 1, integration N % 4 = 2, development N
    % 4 = 3 (32 products)

### Subnet

-   2 public subnets in different AZ for each per VPC
-   2 private subnets in different AZ for each per service
-   Network address: public 10.N.[0,1].0/24, private 10.N.M.0/24, where M assigned
    per service [2,3], [4,5], …, [254,255] \(127 services per product, 502 instances
    per service)

### Gateway

-   1 internet gateway per VPC
-   1 NAT gateway (for outgoing traffic from private networks) per public subnet
-   1 NAT instance (for bastion host to bridge hosts in private networks) per public
    subnet
-   1 VPC peered connection (for peering hub VPC) per VPC
-   1 VPC endpoint per S3 bucket accessed internally
-   API gateway: 1 API per service, 1 stage per environment

### Security Group

-   1 security group per service instance/resource type

### Role

-   1 role per service instance/resource type

### Resource Name

-   Environment: production ⇒ `prd`, staging ⇒ `stg`, integration ⇒ `stg`, development
    ⇒ `dev`
-   Networking: {product}-{environment}-{resource type}(-{target service}-{availability
    zone})
-   Service: {product}-{environment}-{service}(-{datasource})

### Host Name

-   Public product site: `{product domain}`, `www.{product domain}`, `www-{"stg"|"int"|"dev"}.{product
    domain}`
-   Public product client application: `app.{product domain}`, `app-{"stg"|"int"|"dev"}.{product
    domain}`
-   Public product server application: `api.{product domain}`, `api-{"stg"|"int"|"dev"}.{product
    domain}`
-   Public product operations application: `ops.{product domain}`, `ops-{"stg"|"int"|"dev"}.{product
    domain}`
-   Private service gateway / load balancer: `{service}.{"prd"|"stg"|"int"|"dev"}.{product}.internal`
-   Private service instance(s): `{type}(-{number}).{service}.{"prd"|"stg"|"int"|"dev"}.{product}.internal`

### Security

-   Public connections must be encrypted by TLS 1.2
-   Connections must be authenticated/authorized, except public product website and
    cluster-internal
-   Storages containing personal/confidential information must be encrypted by EBS/S3
    encryption
-   User credentials must be hashed by bcrypt or scrypt when persisted
-   User files must be stored in S3, and instance must not mount it as filesystem
-   All developer/operator accounts/credentials must be managed by IAM
-   SSH must not be enabled except bastion instances
-   SSH sessions must be authenticated by public key and logged by script
-   Bastion instances must be audited by auditd
