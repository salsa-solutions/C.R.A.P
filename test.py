import GitPython
import datetime
import matplotlib.pyplot as plt

# Open the Git repository
repo = git.Repo('.')

# Initialize data lists
dates = []
insertions = []
deletions = []

# Iterate through the commit history and extract code frequency data
for commit in repo.iter_commits():
    dates.append(datetime.datetime.fromtimestamp(commit.committed_date).strftime('%Y-%m-%d'))
    insertions.append(commit.stats.total['insertions'])
    deletions.append(commit.stats.total['deletions'])

# Create a plot
fig, ax = plt.subplots()
ax.bar(dates, insertions, label='Insertions', color='b')
ax.bar(dates, deletions, label='Deletions', color='r')
ax.legend()
plt.xticks(rotation=90)
plt.show()
