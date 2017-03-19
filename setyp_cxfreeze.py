from cx_Freeze import setup, Executable

# Dependencies are automatically detected, but it might need
# fine tuning.
buildOptions = dict(packages = [], excludes = [])

base = 'Console'

executables = [
    Executable('sendmail.py', base=base)
]

setup(name='sendmail',
      version = '1.0',
      description = 'Send emails from the command line',
      options = dict(build_exe = buildOptions),
      executables = executables)
