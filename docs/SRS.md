# Software Requirement Specifications

## Login

## Projects

## Deployments

Upon deployments the system should work as below.

### Pre Deployment Checks

1. Get Required binaries list to run this App.

2. Install missing binaries.

3. Setup binaries and verify installation.

### Deployment

1. Check if user provided deploy directory exsits.

2. Check if its first deployments.

3. If its first deployment.

    1. Create .dep directory.

        1. Create latest_release file

        2. Clone --mirror Repository to .dep/repo

    2. Create shared directory.

    3. Create releases directory.

        1. clone code from .dep/repo to new release directory via git archive (git archive branch | tar -x -f - -C release_path)

        2. Rsync shared dirs content to Shared Dirs and Delete shared directories from releases/{current_release}.

        3. Link shared directories to releases/{current_release}.

        4. Link shared files to releases/{current_release}.

        5. Link latest release to current directory.

4. If its not first deployment.

    1. Update repo code from remote. (git remote update)

    2. Repeat steps from 3.3.2 to 3.3.6.

### Post Deployment Scripts

1. Get Post deployment scripts from project.

2. Run each script after deployment.
